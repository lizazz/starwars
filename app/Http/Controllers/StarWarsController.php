<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StarWarsController extends Controller
{
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
		echo "<table>";
		while($cart ){
			$answer = $this->CurlCall($_resourceUrl.$i, true, $_postData = array());
			if(is_object($answer) && isset($answer->name)){
				echo "<tr>";
				echo "<td>" . $answer->name . "</td>";
				echo "<td>" . $answer->height . "</td>";
				echo "<td>" . $answer->mass . "</td>";
				echo "<td>" . $answer->hair_color . "</td>";
				echo "<td>" . $answer->skin_color . "</td>";
				echo "<td>" . $answer->eye_color . "</td>";
				echo "<td>" . $answer->birth_year . "</td>";
				echo "<td>" . $answer->gender . "</td>";
				echo "<td>" . $answer->homeworld . "</td>";
				echo "<td>";
				if(is_array($answer->films)){
					echo implode(",", $answer->films);
				}
				echo "</td>";
				echo "<td>";
				if(is_array($answer->species)){
					echo implode(",", $answer->species);
				}
				echo "</td>";
				echo "<td>";
				if(is_array($answer->vehicles)){
					echo implode(",", $answer->vehicles);
				}
				echo "</td>";
				echo "<td>";
				if(is_array($answer->starships)){
					echo implode(",", $answer->starships);
				}
				echo "</td>";
				echo "</tr>";
				
			//	var_dump($answer);
				$i++;
			}else{
				$cart = false;
			}
		}
		echo "</table>";
	/*	if(is_object($answer) && isset($answer->name)){
			var_dump($answer);
		}else{
			echo "<br>end";
		}*/
	}   
}
