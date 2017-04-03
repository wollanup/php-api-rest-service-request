<?php
/**
 * File description
 *
 * @package
 * @version      $LastChangedRevision:$
 *               $LastChangedDate:$
 * @link         $HeadURL:$
 * @author       $LastChangedBy:$
 */

namespace Eukles\Service\Request\QueryModifier\Modifier;

use Eukles\Service\Request\QueryModifier\Modifier\Base\ModifierBase;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Exception\UnknownColumnException;
use Propel\Runtime\ActiveQuery\Exception\UnknownModelException;
use Propel\Runtime\ActiveQuery\ModelCriteria;

/**
 * Class SortModifier
 *
 * @package Ged\Service\RequestQueryModifier
 */
class SortModifier extends ModifierBase
{
    
    const NAME = "sort";
    const DEFAULT_DIRECTION = Criteria::DESC;
    
    /**
     * Return the name of the modifier
     *
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
    
    /**
     * @inheritdoc
     */
    protected function applyModifier(ModelCriteria $query, $clause, array $modifier)
    {
        # Apply filter on the last related model query
        try {
            $query->orderBy($clause,
                (empty($modifier['direction']) ? self::DEFAULT_DIRECTION : $modifier['direction']));
        } catch (UnknownColumnException $e) {
        } catch (UnknownModelException $e) {
        }
    }
    
    /**
     *
     * Has the modifier all required data to be applied?
     *
     * @param array $modifier
     *
     * @return bool
     */
    protected function hasAllRequiredData(array $modifier)
    {
        return array_key_exists('property', $modifier);
    }
}
