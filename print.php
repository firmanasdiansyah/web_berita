<?php
    ob_start();
    include 'connect.php';
    $id = $_GET['id'];
		$sql = "SELECT * FROM posts 
				JOIN authors ON posts.author_id = authors.id 
				JOIN categories ON posts.category_id = categories.id
				JOIN positions ON posts.position_id = positions.id
				WHERE id_posts='$id'";
		$datas = $conn->query($sql);

        while ($data = mysqli_fetch_array($datas)){
            $author = $data['name'];
			$category = $data['category'];
			$title = $data['title'];
			$content = $data['content'];
			$date = $data['date'];
			$picture = $data['picture'];
			$position = $data['position'];
        }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Print</title>
	<style>
	.cardtext {
        text-align : justify;
        color: black;
    }
	</style>
	
<body>

<h2><?php echo $title ?></h2>
<p class="card-text"><small class="text-muted"><?php echo $category ?>  |<?php echo $author ?> - <?php echo $date ?></small></p>

<img src="admin/posts/img/<?php echo $picture ?>"  widhth="100%"alt="">
<div class="card-body">
<p class="cardtext"> <b>FA News</b> - <?php echo $content ?></p>	

</body>
</html>
<?php
	require './mpdf/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
		'orientation'=> 'portrait',
        'margin_top' => 25,
        'margin_bottom' => 25,
        'margin_left' => 25,
        'margin_right' => 25
    ]);

    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));

    $content = $mpdf->Output("cetak.pdf","D");
?>
 