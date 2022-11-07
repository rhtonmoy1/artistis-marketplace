<?php require_once('header.php'); ?>

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


					<form class="print_order">

						<a href="./account-ex.php" class="btn btn-success"> <i class="dwn"></i> Export</a>


						<div class="card-body">

							<form action="" method="GET">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>From Date</label>
											<input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) { echo $_GET['from_date']; } ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>To Date</label>
											<input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) { echo $_GET['to_date'];} ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Click to Filter</label> <br>
											<button type="submit" class="btn btn-primary">Filter</button>
										</div>
									</div>
								</div>
							</form>
						</div>


						<table id="example1" class="table table-bordered table-hover table-striped">

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
                                if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];

                                    $i = 0;

                                    $statement = $pdo->prepare("SELECT *
                                FROM tbl_artist_account 
                                INNER JOIN tbl_order
                                ON tbl_artist_account.payment_id = tbl_order.payment_id
                                WHERE payment_date
                                BETWEEN '$from_date' AND '$to_date'
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




                                <?php
                                }
                                ?>

							</tbody>
						</table>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- PDF generator -->
<script language="javascript">
	function PrintDiv() {
		var divToPrint = document.getElementById('example1');
		var popupWin = window.open('', '_blank', 'width=1100,height=700');
		popupWin.document.open();
		popupWin.document.write('<html><head><link href="http://127.0.0.1:8000/Frontend/css/style.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
		popupWin.document.close();
	}
</script>







<?php require_once('footer.php'); ?>