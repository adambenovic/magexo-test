<?php

namespace Adambenovic\POS\Console;

use Adambenovic\POS\Model\PointOfSaleFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PosAdd extends Command
{
    public const NAME = 'magexo:pos:add';
    public const ARGUMENT_NAME = 'name';
    public const ARGUMENT_ADDRESS = 'address';
    public const ARGUMENT_IS_AVAILABLE = 'is_available';


    private PointOfSaleFactory $posFactory;

    public function __construct(PointOfSaleFactory $posFactory)
    {
        parent::__construct(self::NAME);
        $this->posFactory = $posFactory;
    }

    protected function configure()
    {
        $this->setName(self::NAME)
            ->setDescription('Add new Point Of Sale')
            ->addArgument(self::ARGUMENT_NAME, InputArgument::REQUIRED, 'Name of Point Of Sale')
            ->addArgument(self::ARGUMENT_ADDRESS, InputArgument::REQUIRED, 'Address of Point Of Sale')
            ->addArgument(self::ARGUMENT_IS_AVAILABLE, InputArgument::REQUIRED, 'Should the Point Of Sale be available?')
            ;

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pos = $this->posFactory->create();
        $pos->setName($input->getArgument(self::ARGUMENT_NAME));
        $pos->setAddress($input->getArgument(self::ARGUMENT_ADDRESS));
        $pos->setIsAvailable((bool)$input->getArgument(self::ARGUMENT_IS_AVAILABLE));
        $pos->save();

        return 0;
    }
}
