<?php	
	// з'єднання з базою даних
	$link = mysql_connect('localhost', 'admin', 'admin');
	
	// назва бази даних	
	mysql_select_db('gallery');
	
	// зчитування з бази даних
	function dataBase($request)
	{
		$result = mysql_query($request);
		
		// помилка виконання запиту
		if (!$result) 
		{
			echo '<br>';
			die('Помилка виконання запиту: ' . mysql_error());
		}
		
		// оголошення масиву для зберігання
		$all = array();
		
		// запис всіх даних до масиву
		while ($row = mysql_fetch_assoc($result)) 
		{
			$all[]=$row;
		}
		return $all;	
		close($link);
	}
?>