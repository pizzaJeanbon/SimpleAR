<?php
namespace SimpleAR\Query;

class Delete extends \SimpleAR\Query\Where
{
    protected static $_isCriticalQuery = true;

	public function build($aConditions)
	{
        $this->_where($aConditions);

        if ($this->_bUseModel)
        {
            $this->_arborescenceToSql();
            $sUsingClause = $this->_sJoin ? ' USING ' . $this->_sJoin : '';

            $this->sql .= 'DELETE ' . $this->_oRootTable->alias . ' FROM ' . $this->_oRootTable->name . ' AS ' .  $this->_oRootTable->alias;
            $this->sql .= $sUsingClause;
            $this->sql .= $this->_sWhere;
        }
        else
        {
            $this->sql .= 'DELETE FROM ' . $this->_sRootTable;
            $this->sql .= $this->_sWhere;
        }
	}
}
