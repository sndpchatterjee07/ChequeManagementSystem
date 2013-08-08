<body> 
    <?php 
    include_once("phpReportGen.php"); 
    $prg = new phpReportGenerator(); 
    $prg->width = "100%"; 
    $prg->cellpad = "0"; 
    $prg->cellspace = "0"; 
    $prg->border = "1"; 
    $prg->header_color = "#465584"; 
    $prg->header_textcolor="#FFFFFF"; 
    $prg->body_alignment = "left"; 
    $prg->body_color = "#D1DCEB"; 
    $prg->body_textcolor = "#000000"; 
    $prg->surrounded = '1'; 
    $prg->font_name = "Palatino Linotype"; 

    mysql_connect("localhost","root","password"); 
    mysql_select_db("cheque_management"); 
    //$res = mysql_query("select name, age, area from table1 where age>20"); 
	
    
    $sql_query = $_POST["sql_query"]; // Fetching values from test.html
    
    
    //$res= mysql_query("SELECT * FROM cheque_master c");
    $res= mysql_query($sql_query);
    $prg->mysql_resource = $res; 
    
    //$prg->title = "Test Table"; 
    $prg->generateReport(); 
    ?> 
</body>