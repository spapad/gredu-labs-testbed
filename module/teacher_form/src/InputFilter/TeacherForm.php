<?php
/**
 * gredu_labs
 *
 * @link https://github.com/eellak/gredu_labs for the canonical source repository
 * @copyright Copyright (c) 2008-2015 Greek Free/Open Source Software Society (https://gfoss.ellak.gr/)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */
namespace GrEduLabs\TeacherForm\InputFilter;
use GrEduLabs\TeacherForm\Service;
use Zend\Filter;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
class TeacherForm extends InputFilter
{
    public function __construct()
    {
		$name = new Input('name');
        $name->setRequired(true)
            ->getFilterChain()
            ->attach(new Filter\StringTrim());

        $name->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\StringLength(['min' => 3]));

		$surname = new Input('surname');
        $surname->setRequired(true)
            ->getFilterChain()
            ->attach(new Filter\StringTrim());
        $surname->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\StringLength(['min' => 3]));

        $eidikothta = new Input('eidikothta');
        $eidikothta->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\Digits());



		$arithmitroou = new Input('arithmitroou');
        $arithmitroou->setRequired(true)
          ->getFilterChain()
          ->attach(new Filter\ToInt());
        $arithmitroou->getValidatorChain()
          ->attach(new Validator\NotEmpty())
          ->attach(new Validator\GreaterThan([
              'min'       => 0,
              'inclusive' => false,
          ]));


        $email = new Input('email');
        $email->setRequired(true)
            ->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\EmailAddress([
                'useDomainCheck' => false,
            ]));

        $telef = new Input('telef');
        $telef->setRequired(true)
            ->getFilterChain()
            ->attach(new Filter\Digits());
        $telef->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\StringLength(['min' => 10]))
            ->attach(new Validator\StringLength(['max' => 13]));

        $school = new Input('school');
            $school->setRequired(false)
                ->getFilterChain()
                ->attach(new Filter\StringTrim());

		$schooltelef = new Input('schooltelef');
        $schooltelef->setRequired(false)
            ->getFilterChain()
            ->attach(new Filter\Digits());
        $schooltelef->getValidatorChain()
            ->attach(new Validator\NotEmpty())
            ->attach(new Validator\StringLength(['min' => 10]))
			->attach(new Validator\StringLength(['max' => 13]));

        $projecttitle = new Input('projecttitle');
                $projecttitle->setRequired(false)
                    ->getFilterChain()
                    ->attach(new Filter\StringTrim());

        $projecturl = new Input('projecturl');
                $projecturl->setRequired(false)
                    ->getFilterChain()
                    ->attach(new Filter\StringTrim());

        $projectdescription = new Input('projectdescription');
                $projectdescription->setRequired(false)
                    ->getFilterChain()
                    ->attach(new Filter\StringTrim());

        $comments = new Input('comments');
                $comments->setRequired(false)
                    ->getFilterChain()
                    ->attach(new Filter\StringTrim());

        $this->add($name)
	        ->add($surname)
            ->add($eidikothta)
			->add($arithmitroou)
            ->add($email)
            ->add($telef)
            ->add($schooltelef)
            ->add($school)
            ->add($projecttitle)
            ->add($projecturl)
            ->add($projectdescription)
            ->add($comments);
          }
}
