<?php 
	if($_GET['image']!==NULL)
	$_SESSION['image']=$_GET['image'];
		
	// клас зображення
	include "image_class.php";
	// новий екземпляр класу
	$object = new Image;
	// заповнюємо ім'я
	$object->name=$_SESSION['image'];
	// зчитуємо з бази і заповнюємо атрибути
	$object->ReadDatabase();
		
	// якщо натиснуто зберегти зміни
	if (isset($_POST['save']))
	{
		// оновити коментар
		$object->SetComment($_POST['comment']);
		$object->UpdateСomment();
	}
		
	// якщо натиснуто видалити зображення
	if (isset($_POST['delete']))
	{
		// метод видалення зображення
		$object->DeleteImage();
		// перенаправлення на головну сторінку
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/index.php">';
	}
?>