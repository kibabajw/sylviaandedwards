<h2>Finances:</h2>
<br/>
<table id="example" class="table table-striped table-bordered">
<button id="btn_print_page"><i class="fa fa-print" aria-hidden="true"></i></button><br/><br/>
<thead>
      <tr>
      <th>ORDER ID</th>
      <th>RESEARCHER</th>
      <th>PAGES</th>
      <th>ORDER PRICE</th>
      <th>RESEARCHER'S %</th>
      <th>COMPANY'S %</th>
      </tr>
</thead>
<tbody>
<?php
	if($finances == false){
	   ?>
		 <div class="alert alert-info" role="alert">No financial report</div>
	   <?php
			} else{
				$no = 1;					
				foreach ($finances as $row) {
				?>
					<tr>
						<td><?= $row->order_id; ?></td>
						<td><?= $row->handler_name; ?></td>
						<td><?= $row->num_of_pages; ?></td>
                        <td><?= $row->client_price; ?></td>
                        <td><?= $row->tot_order_price; ?></td>
                        <td><?= $row->companies_cut; ?></td>
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
                pageTitle: "Sylvia & Edwards Research Consultancy Ltd",          // add title to print page
                removeInline: false,    // remove all inline styles
                printDelay: 333,        // variable print delay
                header: "<h3 class='lead'>Financial report</h3>",           // prefix to html
                footer: null,           // postfix to html
                formValues: true,       // preserve input/form values
                canvas: false,          // copy canvas content (experimental)
                base: false,            // preserve the BASE tag, or accept a string for the URL
                doctypeString: '<!DOCTYPE html>', // html doctype
                removeScripts: false,   // remove script tags before appending
                copyTagClasses: false   // copy classes from the html & body tag
            });
        });
    </script>