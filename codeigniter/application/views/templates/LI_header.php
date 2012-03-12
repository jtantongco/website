<html>
<head>
	<title><?php echo $title ?> </title>
</head>
<body>
	<h1>Jeremiah header data to be inserted here!</h1>
</br>
</br>
<h2>Cart has <?php echo $this->cart->total_items(); ?> items 
	worth <?php echo $this->cart->total(); ?> dollars.
</h2>