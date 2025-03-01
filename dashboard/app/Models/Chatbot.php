<?php

namespace App\Models;

use App\Http\Enums\ChatBotInitialPromptEnum;
use App\Http\Enums\ChatbotStatusType;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Chatbot extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }


    public function getStatus(): ChatbotStatusType
    {
        return new ChatbotStatusType($this->status);
    }

    public function setStatus(ChatbotStatusType $status): void
    {
        $this->status = $status->getStatus();
    }

    public function getPromptMessage(): ?string
    {
        return $this->prompt_message ?? ChatBotInitialPromptEnum::AI_COPILOT_INITIAL_PROMPT;
    }

    public function setPromptMessage(string $promptMessage): void
    {
        $this->prompt_message = $promptMessage;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function settings(): HasMany
    {
        return $this->hasMany(ChatbotSetting::class);
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    public function setSwaggerUrl(string $swaggerUrl): void
    {
        $this->swagger_url = $swaggerUrl;
    }

    public function getSwaggerUrl(): ?string
    {
        return $this->swagger_url;
    }

    public function setIsPreMadeDemoTemplate(bool $isPremade)
    {
        $this->is_premade_demo_template = $isPremade;
    }

    public function isPreMadeDemoTemplate(): bool
    {
        return $this->is_premade_demo_template;
    }
}
