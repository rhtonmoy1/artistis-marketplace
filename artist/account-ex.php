<?php include("inc/config.php"); ?>
<table  id="example1" class="table table-bordered table-hover table-striped">

<form class="print_order">
<section class="content-header">
	<div class="content-header-left">
		<h1>View Account</h1>
	</div>

</section>



<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">

<thead class="thead-dark">
    <tr>
        <th width="10">#</th>
        <th width="60">Customer Name</th>
        <th width="60">Customer Mail</th>
        <th width="60">Payment Date</th>
        <th width="60">Payment Amount</th>
        <th width="60">Order ID</th>
        <th width="60">Product ID</th>
        <th width="60">Bank Transaction Tnfo</th>
        <th width="60">Payment Method</th>
        <th width="60">Payment ID</th>
    </tr>
</thead>

<tbody>
    <?php
    $i = 0;
    $statement = $pdo->prepare("SELECT *
                                FROM tbl_artist_account 
                                INNER JOIN tbl_order
                                ON tbl_artist_account.payment_id = tbl_order.payment_id
                                   ");


    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['customer_email']; ?></td>
            <td><?php echo $row['payment_date']; ?></td>
            <td>$<?php echo $row['paid_amount']; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['bank_transaction_info']; ?></td>
            <td><?php echo $row['payment_method']; ?></td>
            <td><?php echo $row['payment_id']; ?></td>


        </tr>
    <?php
    }
    ?>

</tbody>
</table>

</form>


<!-- php excel generator -->
<?php  
  
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=Accounts.xls"); 
  ?>  

<?php require_once('footer.php'); ?>