<?php

namespace Drupal\custom_constraints\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Drupal\taxonomy\Entity\Vocabulary;

/**
 * Validates the UniqueInteger constraint.
 */
class UniqueTermConstraintValidator extends ConstraintValidator {

    /**
     * {@inheritdoc}
     */
    public function validate($entity, Constraint $constraint) {
        if($entity->isNew() && $entity->getEntityTypeId() == 'taxonomy_term') {
            $newTermName = $entity->getName();
            $vocabId = $entity->bundle();
            $vocabObj = Vocabulary::load($vocabId);
            if (!empty($this->isUnique($newTermName, $vocabId))) {
                // The value is not unique, so a violation is applied. The type of violation applied comes from the constraint description
                $this->context->addViolation($constraint->notUnique, ['%term' => $newTermName, '%vocab' => $vocabObj->label()]);
            }
        }
    }

    // check for a unique term value for passed vocab id
    private function isUnique($newTermName, $vocabId) {
    return \Drupal::entityQuery('taxonomy_term')
      ->condition('name', $newTermName)
      ->condition('vid', $vocabId)
      ->execute();
    }
}
