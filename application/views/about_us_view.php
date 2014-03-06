<div id="about_us_container" class="hideable">
	<?php 
		$data['page'] = 'about_us';
		$this->load->view('search_results_view.php',$data); ?>
	<div id="content">
		<?php $this->load->view('coolcarousel'); ?>
		<?php $this->load->view('about_us'); ?>
	</div>
</div>