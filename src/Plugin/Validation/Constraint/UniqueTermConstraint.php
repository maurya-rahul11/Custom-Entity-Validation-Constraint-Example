<?php

namespace Drupal\custom_constraints\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Plugin implementation of the 'UniqueTermConstraint'.
 *
 * @Constraint(
 *   id = "UniqueTermConstraint",
 *   label = @Translation("Unique Term in a vocabulary", context = "Validation"),
 *   type = "taxonomy_term entity"
 * )
 */
class UniqueTermConstraint extends Constraint {

    // The message that will be shown if the value is not unique.
    public $notUniqueMsg = 'Term creation failed: %term is already exists in %vocab vocabulary. Please create unique term.';
}
