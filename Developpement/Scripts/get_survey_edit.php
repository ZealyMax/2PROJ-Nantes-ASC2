<?php 
															if($_SESSION['survey'] != 0)
															{
																$sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_SESSION['survey'];
																$resSurvey = mysqli_query($conn, $sql);
																$resultSurvey = $resSurvey->fetch_assoc();
																echo " 
<div class=container>
	<div class=headQuestion>
		<input class=mainTitle name=Titre placeholder='Titre du formulaire' value='". $resultSurvey['title'] ."'>
		<input class=mainDesc name=Description placeholder='Description du formulaire' value='". $resultSurvey['description'] ."'>
	</div>
	<div class=contentQuestion>
		<div class=module>
			<div class=insideModule>
				<input class='btn-add' type=button value='&nbsp;'>
				<input class='btn-save' name=submit type=submit value='&nbsp;'>
				<input class='btn-del' id=". $_SESSION['survey'] . " type=button value='&nbsp;'>
			</div>
		</div>
		<div class=form>";
																$sql = "SELECT question, id_questions, type, mustDo FROM questions WHERE id_surveys =". $_SESSION['survey'];
																$resQuestion = mysqli_query($conn, $sql);
																$i = 0;
																while ( $resultQuestion = $resQuestion ->fetch_assoc())
																{
																	#Entête Question
																	/*echo "<script>document.getElementbyClassName('btn-add').click();</script>";*/
																	//echo "<h1>test</h1>"
																	echo "

			<div class='question-div' draggable='true'>
				<input class=question-title name=question[] value='". $resultQuestion['question'] ."'>
				<select class=select-choice name=selectType[]>  
					<option value=\"short\""; if ($resultQuestion['type'] == "short") echo 'selected'; echo">Réponse courte</option>
					<option value=\"long\""; if ($resultQuestion['type'] == "long") echo 'selected' ;echo">Paragraphe</option>
					<option value=\"multiple\""; if ($resultQuestion['type'] == "multiple") echo 'selected' ;echo">Choix multiple</option>
					<option value=\"checkbox\""; if ($resultQuestion['type'] == "checkbox") echo 'selected' ;echo">Case à cocher</option>
					<option value=\"list\""; if ($resultQuestion['type'] == "list") echo 'selected' ;echo">Liste déroulante</option>
					<option value=\"linear-scale\""; if ($resultQuestion['type'] == "linear-scale") echo 'selected' ;echo">Echelle linéaire</option>
					<option value=\"grid-multiple\""; if ($resultQuestion['type'] == "grid-multiple") echo 'selected' ;echo">Grille à choix multiple</option>
					<option value=\"grid-checkbox\""; if ($resultQuestion['type'] == "grid-checkbox") echo 'selected' ;echo">Grille de case à cocher</option>
					<option value=\"date\""; if ($resultQuestion['type'] == "date") echo 'selected' ;echo">Date</option>
					<option value=\"hour\""; if ($resultQuestion['type'] == "hour") echo 'selected' ;echo">Heure</option>
				</select>
																	";
																	#Réponse Courte
																	if($resultQuestion['type'] == "short" )
																	{                                    
																		echo "
				<div class=question-content>
					<input class=short-answer name=\"short\" placeholder=\"Réponse courte \" READONLY>          
				</div>";
																	}   
																	#Paragraphe
																	else if($resultQuestion['type'] == "long")
																	{
																		echo "          
				<div class=question-content>
					<textarea class=long-answer name=\"long\" placeholder=\"Réponse longue\" READONLY></textarea>      
				</div>"; 
																	}
																	#Choix Multiple
																	else if($resultQuestion['type'] == "multiple")
																	{
																		echo "                
				<div class=question-content>";
																		$sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
																		$resSub = mysqli_query($conn, $sql);
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
					<div class=multiple-choice>
						<input name=sub_questions[] type=hidden value='radio'>
						<input class=check-button type=radio disabled>
						<input class=check-name name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'>
						<div>
							<button class='rm-div rm-option'>X</button>
						</div>
					</div>";	        
																		}
																		echo "
					<button class=add-choice>Ajouter une option</button>
				</div>"; 
																	}
																	#Case à cocher
																	else if($resultQuestion['type'] == "checkbox")
																	{
																		echo "
				<div class=question-content>";
																		$sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
																		$resSub = mysqli_query($conn, $sql);
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
					<div class=multiple-choice>
						<input name=sub_questions[] type=hidden value='checkbox'>
						<input class=check-button type=checkbox disabled><input class=check-name name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'>
						<div>
							<button class='rm-div rm-option'>X</button>
						</div>
					</div>";
																		}
																		echo "
					<button class=add-check>Ajouter une option</button>
				</div>"; 
																	}
																	#liste
																	else if($resultQuestion['type'] == "list")
																	{
																		echo "
				<div class=question-content>";
																		$sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
																		$resSub = mysqli_query($conn, $sql);
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
					<div class=multiple-choice>
						<input name=sub_questions[] type=hidden value='list'>
						<input class='check-namelist margin-list' name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'>
						<div>
							<button class='rm-div rm-option'>X</button>
						</div>
					</div>";
																		}
																		echo "
					<button class=add-list>Ajouter une option</button>
				</div>"; 
																	}
																	#échelle linéaire
																	else if($resultQuestion['type'] == "linear-scale")
																	{
																		echo "
				<div class=question-content>";
																		$sql = "SELECT value, type, scale_name FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
																		$resSub = mysqli_query($conn, $sql);
																		echo $resultQuestion['id_questions'] . " test ";// . $resSub; 
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			if($resultSub['type'] == "min-scale")
																			{
																				echo "
					<input name=sub_questions[] type=hidden value=min-scale>
					<div class=select-sameline>
						<input class=check-line name=sub_questions[] value='". $resultSub['scale_name']."' placeholder=Bas>
						<select class=select-linear name=sub_questions[] class=min-scale>";
																				for($i = 0; $i < 2; $i++)
																				{
																					if($i == $resultSub['value'])
																					{
																						echo "
							<option selected>". $i ."</option>";
																					}
																					else
																					{
																						echo "
							<option>". $i ."</option>";
																					}
																				}
																				echo "
						</select>
					</div>";
																			}
																			else
																			{
																				echo "
					<input name=sub_questions[] type=hidden value=max-scale>
					<div class=select-sameline>
						<input class=check-line name=sub_questions[] value='". $resultSub['scale_name']."' placeholder=Haut>
						<select class=select-linear name=sub_questions[] class=max-scale>";
																				for($i = 2; $i < 11; $i++)
																				{
																					if($i == $resultSub['value'])
																					{
																						echo "
							<option selected>". $i ."</option>";
																					}
																					else
																					{
																						echo "
							<option>". $i ."</option>";
																					}
																				}
																				echo "
						</select>
					</div>";
																			}
																		}
																		echo "
				</div>";
																	}
																	#Grille à choix multiple
																	else if($resultQuestion['type'] == "grid-multiple")
																	{
																		echo "
				<div class=question-content>";
																		$sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'line'";
																		$resSub = mysqli_query($conn, $sql);
																		echo "
					<div class=line>";
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
						<div class=multiple-choice>
							<input name=sub_questions[] type=hidden value='line'>
							<input class='check-namelist margin-list' name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'>
							<div>
								<button class='rm-div rm-option'>X</button>
							</div>
						</div>";
																		}
																		echo "
						<button class=add-line>Ajouter une option</button>
					</div>					
					<div class=column>";
																		$sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'column-multiple'";
																		$resSub = mysqli_query($conn, $sql);
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
						<div class=multiple-choice>
							<input class=check-button type=radio disabled>
							<input name=sub_questions[] type=hidden value='column-multiple'>
							<input class=check-name name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'>
							<div>
								<button class='rm-div rm-option'>X</button>
							</div>
						</div>";
																		}
																		echo "
						<div>
							<button class=add-column-multiple>Ajouter une option</button>
						</div>
					</div>
				</div>"; 
																	}   
																	#Grille de case à cocher
																	else if($resultQuestion['type'] == "grid-checkbox")
																	{
																		echo "
				<div class=question-content>";
																		$sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'line'";
																		$resSub = mysqli_query($conn, $sql);
																		echo "
					<div class=line>";
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
						<div class=multiple-choice>
							<input name=sub_questions[] type=hidden value='line'>
							<input class='check-namelist margin-list' name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'>
							<div>
								<button class='rm-div rm-option'>X</button>
							</div>
						</div>";
																		}
																		echo "
						<button class=add-line>Ajouter une option</button>
					</div>					
					<div class=column>";
																		$sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'column-checkbox'";
																		$resSub = mysqli_query($conn, $sql);
																		while($resultSub = $resSub->fetch_assoc())
																		{
																			echo "
						<div class=multiple-choice>
							<input class=check-button type=checkbox disabled>
							<input name=sub_questions[] type=hidden value='column-checkbox'>
							<input class=check-name name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'>
							<div>
								<button class='rm-div rm-option'>X</button>
							</div>
						</div>";
																		}
																		echo "
						<div>
							<button class=add-column-checkbox>Ajouter une option</button>
						</div>
					</div>
				</div>"; 
																	}
																	#Date
																	else if($resultQuestion['type'] == "date" )
																	{
																		echo "
				<div class=question-content>
					<input class=short-answer name=\"short\" placeholder=\"Date \" READONLY>          
				</div>";
																	}
																	#Hour
																	else if($resultQuestion['type'] == "hour" )
																	{
																		echo "
				<div class=question-content>
					<input class=short-answer name=\"short\" placeholder=\"Hour \" READONLY>          
				</div>";
																	}





																	#Affichage des mustDo
																	if($resultQuestion['mustDo'] == 1)
																	{
																		echo  "
				<hr class=requiered-bar>
				<div class=requiered-field>
					<input type=hidden name=sub_questions[] value='new question'>
					<p>Obligatoire</p>
					<input class=check-requiered name=mustDo[] type=checkbox value=". $i . " checked>
					<div class=vertical-bar>&nbsp;</div>
					<div>&nbsp;</div>
					<button class='rm-div rm-division'>X</button>
				</div>
			</div>";
																	}
																	else
																	{
																		echo  "
				<hr class=requiered-bar>
				<div class=requiered-field>
					<input type=hidden name=sub_questions[] value='new question'>
					<p>Obligatoire</p>
					<input class=check-requiered name=mustDo[] type=checkbox value=". $i . ">
					<div class=vertical-bar>&nbsp;</div>
					<div>&nbsp;</div>
					<button class='rm-div rm-division'>X</button>
				</div>
			</div>";
																	}
																	$i++;                                                                          
																}
															echo "
		</div>
	</div>
</div>";

															}
															else
															{
#Else du "if($_SESSION['survey'] != 0)"
																echo " 
<div class=container>
	<div class=headQuestion>
		<input class=mainTitle name=Titre placeholder='Titre du formulaire'>
		<input class=mainDesc name=Description placeholder='Description du formulaire'>
	</div>
	<div class=contentQuestion>
		<div class=module>
			<div class=insideModule>
				<input class='btn-add' type=button value='&nbsp;'>
				<input class='btn-save' name=submit type=submit value='&nbsp;'>
				<input class='btn-del' id=". $_SESSION['survey'] . " type=button value='&nbsp;'>
			</div>
		</div>
		<div class=form>
		</div>
	</div>";
															}
?>  