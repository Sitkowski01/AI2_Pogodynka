<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 2)]
    private ?string $country = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 7)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 7)]
    private ?string $longitude = null;

    #[ORM\OneToMany(mappedBy: 'Location', targetEntity: Measurement::class)]
    private Collection $weatherForecasts;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Measurement::class)]
    private Collection $measurements;

    public function __construct()
    {
        $this->weatherForecasts = new ArrayCollection();
        $this->measurements = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, Measurement>
     */
    public function getWeatherForecasts(): Collection
    {
        return $this->weatherForecasts;
    }

    public function addWeatherForecast(Measurement $weatherForecast): static
    {
        if (!$this->weatherForecasts->contains($weatherForecast)) {
            $this->weatherForecasts->add($weatherForecast);
            $weatherForecast->setLocation($this);
        }

        return $this;
    }

    public function removeWeatherForecast(Measurement $weatherForecast): static
    {
        if ($this->weatherForecasts->removeElement($weatherForecast)) {
            // set the owning side to null (unless already changed)
            if ($weatherForecast->getLocation() === $this) {
                $weatherForecast->setLocation(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Measurement>
     */
    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function addMeasurement(Measurement $measurement): static
    {
        if (!$this->measurements->contains($measurement)) {
            $this->measurements->add($measurement);
            $measurement->setLocation($this);
        }

        return $this;
    }

    public function removeMeasurement(Measurement $measurement): static
    {
        if ($this->measurements->removeElement($measurement)) {
            // set the owning side to null (unless already changed)
            if ($measurement->getLocation() === $this) {
                $measurement->setLocation(null);
            }
        }

        return $this;
    }



}
