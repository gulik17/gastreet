<?php
/**
 * Менеджер каметов к контенту сайта
 */
class CoCommentManager extends BaseEntityManager
{
	// Получить элемент по id и типу
	public function getByIdAndType($id, $commType = CoComment::COMMENT_CONTENT)
	{
		$id = intval($id);
		if ($id > 0)
		{
			$sql = new SQLCondition("id = {$id} AND type = '{$commType}'");
			$comm = $this->getOne($sql);
			return $comm;
		}
	}

	// все немодерированные комментарии
	public function getAllNew($commType = CoComment::COMMENT_CONTENT)
	{
		$sql = "SELECT
					comm.id, comm.dateCreate, comm.body, comm.userId,
					comm.headId, comm.level, comm.sourceId,
					comm.isAnon, us.nickName AS nick
				FROM
					coComment AS comm
				INNER JOIN
					user AS us
				ON
					comm.userId = us.id
				WHERE";

		if ($commType == CoComment::COMMENT_CONTENT || $commType == CoComment::COMMENT_PROFI)
			$sql = $sql." comm.status = '".CoComment::STATUS_NEW."' ";
		else
			$sql = $sql." comm.status != '".CoComment::STATUS_ANSWERED."' ";

		$sql = $sql." AND comm.type = '{$commType}'
				ORDER BY
					comm.id";

		$res = $this->getByAnySQL($sql);
		return $res;

	}

	// отдает id последнего камента по этой странице
	public function getLastCommentId($contentId, $commType = CoComment::COMMENT_CONTENT)
	{
		$sql = "SELECT id FROM coComment WHERE headId = {$contentId} AND type = '{$commType}' ORDER BY id DESC LIMIT 1";
		$rez = $this->getColumn($sql);
		if (count($rez) > 0)
			return $rez[0];

	}

	// отмодерированные комментарии к заголовку закупки по id
	// только верхний уровень
	public function getModByHeadId($headId, $commType = CoComment::COMMENT_CONTENT, $ownerView = false)
	{
		$headId = intval($headId);
		if ($headId > 0)
		{
			$ownerFilter = "";
			if (!$ownerView)
				$ownerFilter = " AND (comm.status = '".CoComment::STATUS_MODERATED."' OR comm.status = '".CoComment::STATUS_ANSWERED."')";

			$sql = "SELECT
						comm.id, comm.dateCreate, comm.body, comm.userId, comm.status,
						comm.level, comm.rootId, comm.sourceId, comm.nickName AS showName,
						comm.isAnon, us.nickName AS nick
					FROM
						coComment AS comm
					INNER JOIN
						user AS us
					ON
						comm.userId = us.id
					WHERE
						comm.headId = {$headId}
						{$ownerFilter}
						AND isPrivate IS NULL AND comm.sourceId IS NULL AND comm.level IS NULL
						AND comm.type = '{$commType}'
					ORDER BY
						comm.id";

			$res = $this->getByAnySQL($sql);
			return $res;
		}

		return false;
	}


	// отмодерированные комментарии к каментариям
	public function getSubModByHeadId($rootId, $commType = CoComment::COMMENT_CONTENT)
	{
		$rootId = intval($rootId);
		if ($rootId > 0)
		{
			$sql = "SELECT
						comm.id, comm.dateCreate, comm.body, comm.userId,
						comm.level, comm.sourceId, comm.nickName AS showName,
						comm.isAnon, us.nickName AS nick
					FROM
						coComment AS comm
					INNER JOIN
						user AS us
					ON
						comm.userId = us.id
					WHERE
						comm.rootId = {$rootId} AND isPrivate IS NULL
						AND (comm.status = '".CoComment::STATUS_MODERATED."' OR comm.status = '".CoComment::STATUS_ANSWERED."')
						AND comm.type = '{$commType}'
					ORDER BY
						comm.weight";

			$res = $this->getByAnySQL($sql);
			return $res;
		}

	}


	// отмодерированные комментарии к каментариям
	public function getAllSubComments($headId, $commType = CoComment::COMMENT_CONTENT, $ownerView = false)
	{
		$headId = intval($headId);
		if ($headId > 0)
		{
			$ownerFilter = "";
			if (!$ownerView)
				$ownerFilter = " AND (comm.status = '".CoComment::STATUS_MODERATED."' OR comm.status = '".CoComment::STATUS_ANSWERED."')";

			$sql = "SELECT
						comm.id, comm.dateCreate, comm.body, comm.userId, comm.status,
						comm.level, comm.sourceId, comm.rootId, comm.nickName AS showName,
						comm.isAnon, us.nickName AS nick
					FROM
						coComment AS comm
					INNER JOIN
						user AS us
					ON
						comm.userId = us.id
					WHERE
						comm.headId = {$headId} AND comm.rootId IS NOT NULL AND isPrivate IS NULL
						{$ownerFilter}
						AND comm.type = '{$commType}'
					ORDER BY
						comm.weight";

			$res = $this->getByAnySQL($sql);
			return $res;
		}

		return false;
	}


	// новые сообщения для покупателя
	public function getNewByUserId($userId, $commType = CoComment::COMMENT_CONTENT)
	{
		$userId = intval($userId);

		if ($userId > 0)
		{
			$sql = "SELECT
						comm.id, comm.dateCreate, comm.body, comm.userId,
						comm.level, comm.sourceId, comm.nickName AS showName,
						comm.isAnon, comm.headId, us.nickName AS nick
					FROM
						coComment AS comm
					INNER JOIN
						user AS us
					ON
						comm.userId = us.id
					WHERE
						comm.toId = {$userId} AND comm.toType = '".CoComment::TYPE_USER."' AND wasRead IS NULL
						AND comm.status = '".CoComment::STATUS_MODERATED."' AND comm.type = '{$commType}'
					ORDER BY
						comm.weight";

			$res = $this->getByAnySQL($sql);

			return $res;
		}

	}

}
