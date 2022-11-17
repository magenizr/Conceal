<?php
declare(strict_types=1);

/**
 * Magenizr Conceal
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\Conceal\Console\Command;

use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Config\ReinitableConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class Config extends Command
{
    private const STATUS = 'status';

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @var ReinitableConfigInterface
     */
    private $reinitableConfig;

    /**
     * Init Constructor
     *
     * @param ReinitableConfigInterface $reinitableConfig
     * @param WriterInterface $configWriter
     */
    public function __construct(
        ReinitableConfigInterface $reinitableConfig,
        WriterInterface $configWriter
    ) {
        $this->reinitableConfig = $reinitableConfig;
        $this->configWriter = $configWriter;

        parent::__construct();
    }

    /**
     * Init Configure
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('magenizr:conceal:config');
        $this->setDescription('Console for Magenizr Conceal');
        $this->addOption(
            self::STATUS,
            null,
            InputOption::VALUE_OPTIONAL,
            'Enable / Disable feature temporarily.'
        );

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;
        $statusAllowed = ['enable','disable'];
        $statusData = [
            'enable' => [
                'value' => 1,
                'message' => [
                    'success' => 'Magenizr Conceal has been enabled'
                ]
            ],
            'disable' => [
                'value' => 0,
                'message' => [
                    'success' => 'Magenizr Conceal has been disabled.'
                ]
            ]
        ];

        try {

            $status = $input->getOption(self::STATUS);

            if (!in_array($status, $statusAllowed)) {
                $output->writeln(sprintf(
                    '<error>The provided option %s is not allowed, only %s.</error>',
                    $status,
                    implode(',', $statusAllowed)
                ));

                return 1;
            }

            $this->configWriter->save('admin/magenizr_conceal/enabled', $statusData[$status]['value']);
            $this->reinitableConfig->reinit();

            $output->writeln(sprintf('<info>%s</info>', $statusData[$status]['message']['success']));

        } catch (LocalizedException $e) {
            $output->writeln(sprintf(
                '<error>%s</error>',
                $e->getMessage()
            ));
            $exitCode = 1;
        }

        return $exitCode;
    }
}
