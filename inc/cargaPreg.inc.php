   <?php 
    session_start();
    require_once('../conexion.php');
    $numtopico=0;
    if ($_REQUEST['id_tipo']!=2)
        $querytopico="SELECT * FROM  cat_topico
                      ORDER BY id_cat_topico";
    else 
       $querytopico="SELECT * FROM  cat_topico
                     WHERE id_cat_topico!=3 AND id_cat_topico!=7";
				 
$topico=pg_query($con,$querytopico);
  
		$lab=$_POST['id_lab'];
		echo $lab;
		
		$html='<table class="table">
                                <thead>
                                    <tr>
                                        
                                    </tr>
                                </thead>
                                <tbody> ';
		
        $numpreg=0;
        while ($nomTopico = pg_fetch_array($topico, NULL,PGSQL_ASSOC)) { 
		

       $numtopico=$numtopico+1;
       if($_REQUEST['id_tipo']==2){
		  if($nomTopico['id_cat_topico']==3 || $nomTopico['id_cat_topico']==7)
		      $nomTopico['id_cat_topico']=0;
	    }
		if($numtopico==1) {$letra='A';}
		if($numtopico==2) {$letra='B';}
		if($numtopico==3) {$letra='C';}
		if($numtopico==4) {$letra='D';}
		if($numtopico==5) {$letra='E';}
		if($numtopico==6) {$letra='F';}
		if($numtopico==7) {$letra='G';}
		
        
                     $html.='     
					 <tr bgcolor="#ccc">
                                <td ><h4>'.$letra.'</h4></td>'.
                                '<td ><h4>'.$nomTopico["nomb_topico"].'</h4></td>
                     </tr>';
        
	
	  
	   $querypreg="SELECT * FROM cat_topico ct
                   JOIN  cat_preg cp
                   ON cp.id_cat_topico=ct.id_cat_topico
				   JOIN formato f
                   ON f.id_preg=cp.id_preg
                   WHERE  ct.id_cat_topico=". $nomTopico['id_cat_topico'] .
				  "AND id_lab=" .$lab.
				  " AND f.vigencia_actual=1
				   ORDER BY cp.id_preg" ;
	   
	    $preg = pg_query($con,$querypreg);           
	   // echo $query;
        while ($pregunta= pg_fetch_array($preg, NULL,PGSQL_ASSOC)) 
		{ 
					  $numpreg=$numpreg+1;
		 
         
        $html.='
              <tr> 
                  <td align="left"> '.$numpreg.'</td>'.
                 '<td align="left">'.$pregunta["pregunta_texto"].'</td>
              </tr>';
				 
		 }//preguntas
		}//topicos
	// } // fin del if isset
		$html.=' </tbody>
       </table>';
       echo $html;