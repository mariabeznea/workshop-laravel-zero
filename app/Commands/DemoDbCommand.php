<?php

namespace App\Commands;

use App\Models\Quote;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

class DemoDbCommand extends Command {
	/**
	 * The signature of the command.
	 *
	 * @var string
	 */
	protected $signature = 'test:db';

	/**
	 * The description of the command.
	 *
	 * @var string
	 */
	protected $description = 'Testing DB persistence';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$inputFile = $this->choice( 'Please choose your input file from the list', Storage::files( ) );

		if ( ! Storage::exists( $inputFile ) ) {
			throw new \RuntimeException( 'Source file does not exist' );
		}

		$fileContent = collect( explode( PHP_EOL, trim( Storage::get( $inputFile ) ) ) );
		$this->persistContent( pathinfo( $inputFile, PATHINFO_FILENAME ), $fileContent );

		$this->warn( 'Total rows persisted: ' . $fileContent->count() );
		$this->table( [ 'Quote', 'Author' ], Quote::all() );

		render(view('table-content', [
			'fileContent' => $fileContent,
			'quotes' =>  Quote::all(),
		]));
	}

	/**
	 * @param string $name
	 * @param Collection $content
	 *
	 * @return void
	 */
	private function persistContent( string $name, Collection $content ) {
		$content->each( function ( $json ) use ( $name ) {
			$json = json_decode( $json, true );
			Quote::insert( $this->parseQuoteValues( $name, $json ) );
		} );
	}

	/**
	 * @param string $source
	 * @param array $json
	 *
	 * @return array
	 */
	private function parseQuoteValues( string $source, array $json ): array {
		$data = [];
		if ( Str::contains( strtolower( $source ), 'breakingbad' ) ) {
			foreach ( $json as $row ) {
				$data[] = [ 'quote' => $row['quote'], 'author' => $row['author'] ];
			}
		}
		if ( Str::contains( strtolower( $source ), 'chucknorris' ) ) {
			$data[] = [ 'quote' => $json['value'], 'author' => 'Chuck Norris' ];
		}

		return $data;
	}

}
