<h2>Orders distribution:</h2>
<br/>
<table id="example" class="table table-striped table-bordered">
<button id="btn_print_page"><i class="fa fa-print" aria-hidden="true"></i></button><br/><br/>
<h3>TOT PRICE: <span id="tot_orders_price"></span></h3>
<thead>
      <tr>
      <th>WRITER</th>
      <th>ORDERS</th>
      <th>MONTH</th>
      <th>YEAR</th>
      <th>STATUS</th>
      <th>TOTAL PAGES</th>
      <th>PRICE</th>
      </tr>
</thead>
<tbody>
<?php
	if($mydata == false){
	   ?>
		 <div class="alert alert-info" role="alert">No statistics yet</div>
	   <?php
			} else{
				$no = 1;					
				foreach ($mydata as $row) {
				?>
					<tr>
						<td><?= $row->Writer; ?></td>
						<td><?= $row->Orders; ?></td>
						<td><?= $row->Month; ?></td>
						<td><?= $row->Year; ?></td>
						<td><?= $row->Status; ?></td>
                        <td><?= $row->Pages; ?></td>
                        <td><?= $row->my_price; ?></td>
            		</tr>  
				<?php	
			}
		}
?>     
</tbody>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>print-this-js/printThis.js"></script>
    <script>
        $('#btn_print_page').click(function(){
            $('.table').printThis({
                debug: false,           // show the iframe for debugging
                importCSS: true,        // import parent page css
                importStyle: true,     // import style tags
                printContainer: true,   // print outer container/$.selector
                pageTitle: "Write Bright Research Consultancy Ltd",          // add title to print page
                removeInline: false,    // remove all inline styles
                printDelay: 333,        // variable print delay
                header: "<h3 class='lead'>Monthly orders distribution</h3>",           // prefix to html
                footer: null,           // postfix to html
                formValues: true,       // preserve input/form values
                canvas: false,          // copy canvas content (experimental)
                base: false,            // preserve the BASE tag, or accept a string for the URL
                doctypeString: '<!DOCTYPE html>', // html doctype
                removeScripts: false,   // remove script tags before appending
                copyTagClasses: false   // copy classes from the html & body tag
            });
        });

        var vr_sums = {}
        vr_sums.notify_sums = function(){
        var sums_url = '<?php echo base_url(); ?>index.php/admin/dashboard_controller/tot_orders_price';
        $.get(sums_url, function(response){
            $("#tot_orders_price").html(response);
        });
        }
        vr_sums.interval = setInterval(vr_sums.notify_sums, 2000);
        vr_sums.notify_sums();
    </script>
</body>
</html>