<?php
/**
* Сообщения для пользователя от кого-то другого
*/
class MessageToManager extends BaseEntityManager
{
	// получить сообщения для текущего актора
	public function getMessages($userId, $actorId, $mindate = 0, $maxdate = 0)
	{
		if ($maxdate)
			$sql = new SQLCondition("userId = {$actorId} AND userToId = {$userId} AND dateCreate > {$mindate} AND dateCreate < {$maxdate}");
		else
			$sql = new SQLCondition("userId = {$actorId} AND userToId = {$userId} AND dateCreate > {$mindate}");

		$sql->orderBy = "dateCreate";
		return $this->get($sql);
	}

	// получить сообщения позднее или сделанные в заданное время
	public function getLatestMessages($actorId, $userId, $dateCreate)
	{
		$sql = new SQLCondition("userId = {$userId} AND userFromId = {$actorId} AND dateCreate >= {$dateCreate}");
		return $this->get($sql);
	}

	// вставить новое сообщение
	public function addMessage($actorId, $userId, $dateCreate, $message)
	{
		$mfObj = new MessageTo();
		$mfObj->userId = $actorId;
		$mfObj->userToId = $userId;
		$mfObj->message = $message;
		$mfObj->dateCreate = $dateCreate;
		$mfObj->dateUpdate = time();
		return $this->save($mfObj);

	}

	// получить дату, от которой
	public function getMessToFromDate($lastReadId)
	{
		$mindate = 0;
		$sql = "SELECT dateCreate AS mindate FROM messageFrom WHERE id = {$lastReadId}";
		$res = $this->getOneByAnySQL($sql);
		if ($res)
			$mindate = intval($res['mindate']);

		if ($mindate > 0)
			return $mindate;
		else
			return time();

	}

}
