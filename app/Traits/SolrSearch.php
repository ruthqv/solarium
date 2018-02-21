<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Solarium\Client;
use App\Http\Requests\SolrRequest;

trait SolrSearch
{
    private function formatData($documents = null ){

    	if($documents){
    		$final =[];
	        foreach ($documents as $document) {

	            // the documents are also iterable, to get all fields
	            foreach ($document as $field => $value) {
	                 // this converts multivalue fields to a comma-separated string
	                if (is_array($value)) {
	                    $value = implode(', ', $value);	      
	                }

	            	$documentsfinal[$field] = $value;
    
	            }
	        	array_push($final,$documentsfinal);
	        } 
	    	return $final;
    	}
    
    }
    /**
     * findSolrResults will filter search by one given $field, and will use $value or a values range given into $values
     * @param  string $field   field to search
     * @param  string $value   value to search into field
     * @param  array  $values  array of values to apply range example:('10','20')
     * @param  string $shortBy if want to short results
     * @return array          object directy extracted from the solr response will be convert into Array
     */
    public function findSolrResults(SolrRequest $request){
        
        $solr = new Client(config('solarium'));

    	$data = $request->all();

        $query = $solr->createSelect();

    	isset($data['value']) ?  $data['value'] = $data['value'] : $data['value'] = '*';

	        if(isset($data['values']) && is_numeric($data['values'][0]) && is_numeric($data['values'][1]) ){
	        	$stringComposition =''.$data['field'].':['.$data['values'][0].' TO '.$data['values'][1].']';


	        }else{
	        	$stringComposition =''.$data['field'].':'.$data['value'].'';
	        }

        	$toSearchString = (String)$stringComposition;

        	$query->setQuery(''.$toSearchString.'');


	        if(isset($data['shortBy'] )){
	        
    		// All childs of this SolrSearch class can extend getColumns method by itself with getColumns method
	        	$query->setFields($this->getColumns());
	        	$query->addSort(''.$data['shortBy'].'', $query::SORT_DESC);
	        }

	        $resulset = $solr->select($query);

			$resulset->getNumFound();
	        $transform = $this->formatData($resulset);
	        return $transform;
    }
    /**
     * getAllSolrResults will response with the whole collection
     * @return array  object directy extracted from the solr response will be convert into Array
     */
    public function getAllSolrResults(){
        $solr = new Client(config('solarium'));
        $query = $solr->createSelect();
        $resulset = $solr->select($query);
        $resulset->getDocuments();
        $transform = $this->formatData($resulset);
        return $transform;
    }

}
