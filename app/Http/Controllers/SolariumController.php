<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolariumController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function ping()
    {
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }

 	public function search()
    {
        $query = $this->client->createSelect();
        $query->addFilterQuery(array('key'=>'hotel_id', 'query'=>'firstname:Amber', 'tag'=>'include'));

        $resulset = $this->client->select($query);

        // display the total number of documents found by solr
        echo 'NumFound: ' . $resulset->getNumFound();

        // show documents using the resultset iterator
        foreach ($resulset as $document) {

            echo '<hr/><table>';

            // the documents are also iterable, to get all fields
            foreach ($document as $field => $value) {
                // this converts multivalue fields to a comma-separated string
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }

                echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
            }

            echo '</table>';
        }
    }    

}
