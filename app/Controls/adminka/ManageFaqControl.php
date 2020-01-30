<?php

class ManageFaqControl extends BaseAdminkaControl
{
	public function render()
	{
		$fm = new FaqManager();
		$faq = $fm->getAll();
		$this->addData("faqList", $faq);
	}
}