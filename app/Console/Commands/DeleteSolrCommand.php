<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Solarium\Client;
class DeleteSolrCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solr:removecollection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $client;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $curl = curl_init();
         $collection= config('solarium.endpoint.localhost.core'); 

          curl_setopt_array($curl, array(
          CURLOPT_PORT => "8983",
          CURLOPT_URL => "http://localhost:8983/solr/admin/cores?action=UNLOAD&deleteInstanceDir=true&core=".$collection."",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        $this->info("\Error Created Collection " .$err);


        } else {
          echo $response;
        $this->info("\nDeleted Collection " .$collection . $response);

        }

    }
}
