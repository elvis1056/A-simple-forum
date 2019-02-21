<?php
	
	function renderDeleteBtn($data_id) {
		return "
			<div class='comment_delete'>
				<form method='POST' action='handle_delete.php'>
					<input type='hidden' name='id' value='$data_id' >
					<input type='submit' class='comment_delete_btn' value='delete'>
				</form>
			</div>
		";
	}

	function renderEditBtn($id) {
		return "
			<div class='comment_edit'>
				<form method='GET' action='edit_comment.php'>
					<input type='hidden' name='id' value='$id' >
					<input type='submit' class='comment_edit_btn' value='編輯'>
				</form>
			</div>
		";
	}

?>