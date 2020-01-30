<?php
/**
 *
 */
class DelInvoiceAction extends AdminkaAction {
	public function execute() {
		$id = Request::getInt("id");

		$im = new InvoicesManager();

        if ($id) {
            $sql = "SELECT `id` FROM `pay` WHERE `id` = {$id} AND `type` = 'TYPE_INVOICE'";
            $res = $im->getByAnySQL($sql);
        }
        if (!$res) {
            Adminka::redirectBack("Счет не найден");
        }
        $query = "DELETE FROM `pay` WHERE `id` = {$id}";
        $im->executeNonQuery($query);
		Adminka::redirect("manageinvoices", "Счет удален");
	}
}