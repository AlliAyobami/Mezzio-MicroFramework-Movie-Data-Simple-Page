<?php
declare(strict_types=1);
namespace App\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
/**
 *
 * @ODM\Document(repositoryClass="App\Repository\Doctrine\UserRepository")
 */
class User
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     */
    protected string $id;
    /**
     * @ODM\Field(type="string")
     * @ODM\UniqueIndex
     */
    protected string $email;
    /**
     * @ODM\Field(type="string")
     */
    protected ?string $password;
    /**
     * Class constructor.
     */
    private function __construct(
        $userId,
        $email,
        $password
    ) {
        $this->email = $emailId->value();
        if ($password) {
            $this->password = $password->toString();
        }
        if ($phoneId) {
            $this->phone = $phoneId->value();
        }
        $this->id = $userId->toString();
    }
    public function getAggregateRootId(): string
    {
        return $this->id;
    }
    public function identity(): Identity
    {
        return Identity::fromString($this->email);
    }
    public function userId(): UserId
    {
        return UserId::fromString($this->id);
    }
    public function token(): Token
    {
        return $this->token;
    }
    public static function registerUserWithPassword(
        UserId $userId,
        Identity $emailId,
        Password $password,
        string $name,
        Identity $phoneId,
        Token $token
    ): self {
        $user = new self(
            $userId,
            $emailId,
            $password,
            $name,
            $phoneId,
            confirmationStatus: false,
            token: $token,
            provider: static::DEFAULT_PROVIDER
        );
        return $user;
    }
    public static function createUserFromOauth(
        UserId $userId,
        Identity $emailId,
        string $name,
        string $provider
    ): self {
        $user = new self(
            userId: $userId,
            emailId: $emailId,
            password: null,
            name: $name,
            phoneId: null,
            confirmationStatus: true,
            token: null,
            provider: $provider
        );
        return $user;
    }
    public static function createUserWithoutPassword(
        UserId $userId,
        Identity $emailId,
        string $name,
        Identity $phoneId,
        Token $token
    ): self {
        $user = new self(
            userId:$userId,
            emailId:$emailId,
            password: null,
            name: $name,
            phoneId: $phoneId,
            confirmationStatus: false,
            token: $token,
            provider: static::DEFAULT_PROVIDER
        );
        return $user;
    }
    public function validateToken($otp): void
    {
        $this->token->verify($otp);
        $this->confirmationStatus = true;
        // $this->apply(new EmailWasConfirmed($this->getAggregateRootId(), $this->email, $this->password));
    }
    public function login(Identity $identity, string $loginPassword): void
    {
        if (!$this->confirmationStatus) {
            throw UserException::notConfirmed();
        }
        if(!isset($this->password)){
            throw UserException::passwordNotSet();
        }
        if (!$this->password()->verify($loginPassword)) {
            throw IdentityException::incorrect($identity);
        }
    }
    public function biometricLogin(Identity $identity, string $loginPassword): void
    {
        if (!$this->confirmationStatus) {
            throw UserException::notConfirmed();
        }
        if(!isset($this->biometricPassword)){
            throw UserException::passwordNotSet();
        }
        if (!$this->biometricPassword()->verify($loginPassword)) {
            throw IdentityException::incorrect($identity);
        }
    }
    public function changePassword(Password $password): void
    {
        $this->password = $password->toString();
        $this->provider = static::DEFAULT_PROVIDER;
    }
    public function changeBiometricPassword(Password $password): void
    {
        $this->biometricPassword = $password->toString();
    }
    public function resetToken(): void
    {
        $this->token = Token::generate();
        //apply new event
        // $this->apply(new ResetTokenWasGenerated($this->email, $token->token(), $token->duration()));
    }
    public function password(): Password
    {
        return (isset($this->password)) ?
            Password::fromHash($this->password)
           
    }
   
}