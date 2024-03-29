<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $accountId = null;

    #[ORM\Column]
    private ?float $gain = null;

    #[ORM\Column]
    private ?float $daily = null;

    #[ORM\Column]
    private ?float $monthly = null;

    #[ORM\Column]
    private ?int $withdrawals = null;

    #[ORM\Column]
    private ?int $deposits = null;

    #[ORM\Column]
    private ?float $interest = null;

    #[ORM\Column]
    private ?float $profit = null;

    #[ORM\Column]
    private ?float $balance = null;

    #[ORM\Column]
    private ?float $drawdown = null;

    #[ORM\Column]
    private ?float $equity = null;

    #[ORM\Column]
    private ?float $equityPercent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastUpdateDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creationDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $firstTradeDate = null;

    #[ORM\Column]
    private ?float $commission = null;

    #[ORM\Column]
    private ?float $profitFactor = null;

    #[ORM\Column]
    private ?float $pips = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    public function setAccountId(int $accountId): static
    {
        $this->accountId = $accountId;

        return $this;
    }

    public function getGain(): ?float
    {
        return $this->gain ? (float) number_format($this->gain, 2) : 0.0;
    }

    public function setGain(float $gain): static
    {
        $this->gain = $gain;

        return $this;
    }

    public function getDaily(): ?float
    {
        return $this->daily;
    }

    public function setDaily(float $daily): static
    {
        $this->daily = $daily;

        return $this;
    }

    public function getMonthly(): ?float
    {
        return $this->monthly;
    }

    public function setMonthly(float $monthly): static
    {
        $this->monthly = $monthly;

        return $this;
    }

    public function getWithdrawals(): ?int
    {
        return $this->withdrawals;
    }

    public function setWithdrawals(int $withdrawals): static
    {
        $this->withdrawals = $withdrawals;

        return $this;
    }

    public function getDeposits(): ?int
    {
        return $this->deposits;
    }

    public function setDeposits(int $deposits): static
    {
        $this->deposits = $deposits;

        return $this;
    }

    public function getInterest(): ?float
    {
        return $this->interest;
    }

    public function setInterest(float $interest): static
    {
        $this->interest = $interest;

        return $this;
    }

    public function getProfit(): ?float
    {
        return $this->profit;
    }

    public function setProfit(float $profit): static
    {
        $this->profit = $profit;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    public function getDrawdown(): ?float
    {
        return $this->drawdown;
    }

    public function setDrawdown(float $drawdown): static
    {
        $this->drawdown = $drawdown;

        return $this;
    }

    public function getEquity(): ?float
    {
        return $this->equity;
    }

    public function setEquity(float $equity): static
    {
        $this->equity = $equity;

        return $this;
    }

    public function getEquityPercent(): ?float
    {
        return $this->equityPercent;
    }

    public function setEquityPercent(float $equityPercent): static
    {
        $this->equityPercent = $equityPercent;

        return $this;
    }

    public function getLastUpdateDate(): ?\DateTimeInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(\DateTimeInterface $lastUpdateDate): static
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeImmutable $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getFirstTradeDate(): ?\DateTimeImmutable
    {
        return $this->firstTradeDate;
    }

    public function setFirstTradeDate(\DateTimeImmutable $firstTradeDate): static
    {
        $this->firstTradeDate = $firstTradeDate;

        return $this;
    }

    public function getCommission(): ?float
    {
        return $this->commission;
    }

    public function setCommission(float $commission): static
    {
        $this->commission = $commission;

        return $this;
    }

    public function getProfitFactor(): ?float
    {
        return $this->profitFactor;
    }

    public function setProfitFactor(float $profitFactor): static
    {
        $this->profitFactor = $profitFactor;

        return $this;
    }

    public function getPips(): ?float
    {
        return $this->pips;
    }

    public function setPips(float $pips): static
    {
        $this->pips = $pips;

        return $this;
    }
}
