<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class StarWarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($hero)
    {
        Person::create($hero);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo "<table>";
        $PersonCollection = Person:all();
        foreach ($PersonCollection => $Person) {
        	echo "<tr>";
			echo '<td><a href="/starwars/' . $Person->id .'/edit">' . $Person->name . '</td>';
			echo "<td>" . $Person->height . "</td>";
			echo "<td>" . $Person->mass . "</td>";
			echo "<td>" . $Person->hair_color . "</td>";
			echo "<td>" . $Person->skin_color . "</td>";
			echo "<td>" . $Person->eye_color . "</td>";
			echo "<td>" . $Person->birth_year . "</td>";
			echo "<td>" . $Person->gender . "</td>";
			echo "<td>" . $Person->homeworld . "</td>";
			echo "<td>";
			if(is_array($Person->films)){
				echo implode(",", $Person->films);
			}
			echo "</td>";
			echo "<td>";
			if(is_array($Person->species)){
				echo implode(",", $Person->species);
			}
			echo "</td>";
			echo "<td>";
			if(is_array($Person->vehicles)){
				echo implode(",", $Person->vehicles);
			}
			echo "</td>";
			echo "<td>";
			if(is_array($Person->starships)){
				echo implode(",", $Person->starships);
			}
			echo "</td>";
			echo '<td><a href ="/deletePerson/' . $Person->id. '">Delete</td>'; 
			echo "</tr>";
        }
        echo "</table>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function CurlCall($_resourceUrl, $_curlCallType, $_postData = array(), $_overrideUrl = false, $_isAttachment = false)
	{
		$_dwkUri = $_resourceUrl;
	    $curl = curl_init(); 
	    curl_setopt($curl, CURLOPT_URL, $_dwkUri . '/?format=json');
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	    $out = curl_exec($curl);
	    curl_close($curl);
		return json_decode($out);
	}

	public function getPersons(){
		$_resourceUrl  = "https://swapi.co/api/people/";
		$number = 100;
		$i = 1;
		$cart = true;

		while($cart ){
			$answer = $this->CurlCall($_resourceUrl.$i, true, $_postData = array());
			if(is_object($answer) && isset($answer->name)){
				$this->store($answer);
				$i++;
			}else{
				$cart = false;
			}
		}
	}   
}
