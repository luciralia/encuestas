<?php 

session_start(); 
require_once('../conexion.php'); 
require_once('../clases/reporte.class.php'); 
$obj_rep=new Reporte(); 
          $queryp="SELECT * FROM formato f
                  JOIN cat_preg cp
                  ON f.id_preg=cp.id_preg
                  JOIN cat_topico ct
                  ON ct.id_cat_topico=cp.id_cat_topico
                  WHERE id_lab=2";

          $registrop = pg_query($con,$queryp);
       
          $nopreg= pg_num_rows($registrop); 
		  
		 
		
		  while ($topico = pg_fetch_array($registrop, NULL,PGSQL_ASSOC)) 
		  {  
		        
		        $queryt="SELECT * FROM formato f
                  JOIN cat_preg cp
                  ON f.id_preg=cp.id_preg
                  JOIN cat_topico ct
                  ON ct.id_cat_topico=cp.id_cat_topico
                  WHERE id_lab=2".
				  "AND ct.id_cat_topico=".$topico['id_cat_topico'];
                  
                  $registrot = pg_query($con,$queryt);
       
                  $nopregxtop= pg_num_rows($registrot); 
				  if ($topico['id_cat_topico']==1)
				      $nopxt1= $nopregxtop;
				  if ($topico['id_cat_topico']==2)
				      $nopxt2= $nopregxtop;	  
				  if ($topico['id_cat_topico']==3)
				      $nopxt3= $nopregxtop;		  
				  if ($topico['id_cat_topico']==4)
				      $nopxt4= $nopregxtop;	  
				  if ($topico['id_cat_topico']==5)
				      $nopxt5= $nopregxtop;	  
				  if ($topico['id_cat_topico']==6)
				      $nopxt6= $nopregxtop;	
			      if ($topico['id_cat_topico']==7)
				      $nopxt7= $nopregxtop;		
					  
					
				
		   }
		   	echo 'topico 1 :' , $nopxt1;  	
					echo 'topico 2 :' , $nopxt2;  	  
					echo 'topico 3 :' , $nopxt3;  	
					echo 'topico 4 :' , $nopxt4; 
					echo 'topico 5 :' , $nopxt5;  	  
					echo 'topico 6 :' , $nopxt6;  	
					echo 'topico 7 :' , $nopxt7;  	
 
 ?>
