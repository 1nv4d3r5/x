<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo implode('::', $vars['xReq']);?></title>

<link rel="stylesheet" type="text/css" href="<?php echo xConfigGet('xSite', 'assetRoot'); ?>style.css" />

</head>

<body>

<div id="wrapper">
	<div id="content">
    
    	<div id="header">
        	<h1><a href="#">xSite - x Framework Example</a></h1>            
        </div><!-- header -->
        
        <div id="menu">
        	<ul>	
            	<li class="selected"><a href="<?php echo xRequestOut(array('Default', '')); ?>">Home</a> /</li>
                <li><a href="<?php echo xRequestOut(array('Users', 'List')); ?>">Users</a> /</li>
                <li><a href="<?php echo xRequestOut(array('Blog', 'Index')); ?>">Blog</a> /</li>
                <li><a href="<?php echo xRequestOut(array('Users', 'Logout')); ?>">Logout</a></li>
        	</ul>
        </div>
       <div id="container">
       
      <div id="sidebar">
        
        	<h4>/Information</h4>
<h3><a href="#">x PHP Framework</a></h3>
            <p>Michael J. Burgess, 2010.<br />
              <br />
              http://www.xphp.org
              <br />
              <br />
<img src="<?php echo xConfigGet('xSite', 'assetRoot'); ?>images/linija.png" border="0" alt="" /></p>
            <p>&nbsp;</p>
      </div>
      <!--sidebar-->
        
        <div id="main">
        	<h2><span class="blue">/<?php echo implode('/', $vars['xReq']);?></span></h2>
            
            <blockquote><a href="http://www.xphp.org">xphp.org</a></blockquote>
             
             <img src="<?php echo xConfigGet('xSite', 'assetRoot'); ?>images/velikalinija.png" alt="" border="0" class="line"/>
                        
            <p><?php echo $content; ?></p>
        </div><!--main-->
        

        
        	<div style="clear:both;"></div>
       </div><!--container-->
       
        
        <div id="footer">
        	<span>&copy;2010 Michael J. Burgess, xphp.org</span>
            
            <ul>
            	<li><a href="#">Home</a> |</li>
                <li><a href="#">Site Map</a> |</li>
                <li></li>
                <li><a href="#">Contact</a> |</li>
                <li><a href="http://vectorart.org">Design by Vector</a></li> 
            </ul>
        
        </div><!--footer-->
       
	 </div><!-- content -->

	</div><!-- wrapper -->


 </body>
</html>
