     <?php
	 require_once('../conexion.php');
	 require_once('../clases/laboratorio.class.php');
	 session_start();
	 
	 //echo 'valores post';
	 //print_r($_POST);
    
	 $labs = new laboratorio();
	
	
                                            $labs = '<form>
											          <table> ';
	                                        $iddep = $_POST['id_dep'];
											
	                                        $query="SELECT *
                                                    FROM division d
                                                    JOIN departamento dp
                                                    ON d.id_div=dp.id_div
                                                    JOIN laboratorio l
                                                    ON l.id_dep=dp.id_dep
				                                    WHERE l.id_dep=" .$iddep;
				
				                         
					                         $result = @pg_query($query) or die('Hubo un error con la base de datos en laboratorio');
						                     $j=1;
						                      while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
						                      { 
						                          $nombrechk="lab".$j;
					
						                          $labs.='<tr><td width="20%" >' . $datosc['nombre_lab'] .'</td><td width="20%" ><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_lab'].'"  /></td></tr> ';
							                      $j++;  
					                          }
				                          //	return $salida;
					                          $labs.=' </table> <input name="j" type="hidden" value="' .$j. '" /> </form> ';
					                         echo $labs; ?>
	                             <!--</div>
	                             </div>  -->
				           
							  
                              