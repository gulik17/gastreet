<?php

/**
 * Запрос к БД
 */
class InvoicesManager extends BaseEntityManager {

    /**
     * Получение данных для отчета по счетам
     * @return array массив данных выборки
     */
    public function getAllInvoice() {
        $SQLRequest = "SELECT
            p.id AS id, p.needAmount, p.payAmount, p.status, p.tsCreated, p.tsUpdated,
            ud.company, ud.inn, ud.kpp, ud.bik, ud.corr, ud.rs, ud.address,
            u.id AS userId, u.phone, u.lastname, u.name, u.email
        FROM `pay` AS p
            LEFT JOIN `user` AS u ON p.userId = u.id
            LEFT JOIN `userDetails` AS ud ON p.userId = ud.userId
        WHERE p.type = 'TYPE_INVOICE'
        ORDER BY p.id DESC;";

        $SQLResponse = $this->getByAnySQL($SQLRequest);
        return $SQLResponse;
    }
}