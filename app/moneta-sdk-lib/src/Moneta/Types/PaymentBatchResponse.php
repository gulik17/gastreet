<?php

// Warning! This code was generated by WSDL2PHP tool. 
// author: Filippov Andrey <afi.work@gmail.com> 
// see https://solo-framework-lib.googlecode.com 

namespace Moneta\Types;

/**
 * Ответ на запрос перевода денежных средств в пакетном режиме.
	 * Response to a request for transferring money to another account in batch mode.
	 * 
 */
class PaymentBatchResponse
{
	
	/**
	 * Детали проведенных операций, либо описание ошибок, если операция не проведена. Порядок соответствует набору операций, переданных в PaymentBatchRequest.
	 * Either information about completed transactions or error descriptions in the same order as in the PaymentBatch request.
	 * 
	 *
	 * @var OperationInfoBatchResponseType
	 */
	 public $transaction = null;

	/**
	 * Детали проведенных операций, либо описание ошибок, если операция не проведена. Порядок соответствует набору операций, переданных в PaymentBatchRequest.
	 * Either information about completed transactions or error descriptions in the same order as in the PaymentBatch request.
	 * 
	 *
	 * @param OperationInfoBatchResponseType
	 *
	 * @return void
	 */
	public function addTransaction(OperationInfoBatchResponseType $item)
	{
		$this->transaction[] = $item;
	}

}
