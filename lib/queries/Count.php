<?php
namespace SimpleAR\Query;

class Count extends \SimpleAR\Query\Where
{
	public function build($aOptions)
	{
		$sRootModel = $this->_sRootModel;
		$sRootAlias = $this->_oRootTable->alias;

		if (isset($aOptions['conditions']))
		{
            $this->_where($aOptions['conditions']);
		}

        $this->_arborescenceToSql();

		$this->sql  = 'SELECT COUNT(*)';
		$this->sql .= ' FROM ' . $this->_oRootTable->name . ' ' . $sRootAlias .  ' ' . $this->_sJoin;
		$this->sql .= $this->_sWhere;
	}

    public function res()
    {
        return $this->_oSth->fetch(\PDO::FETCH_COLUMN);
    }
}
