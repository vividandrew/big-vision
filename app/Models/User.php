<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function PHPUnit\Framework\isEmpty;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var string
     */
    private string $id;
    /**
     * @var string
     */
    private string $FullName;
    /**
     * @var string
     */
    private string $Email;
    /**
     * @var string
     */
    private string $ContactNo;
    /**
     * @var string
     */
    private string $Password;
    /**
     * The Attribute can only be the following roles !TODO:ADD ROLES
     *
     * @var string
     */
    private string $Role;
    /**
     * @var string
     */

    //Customer Specific variables
    private string $AddressLine1;
    /**
     * @var string
     */
    private string $AddressLine2;
    /**
     * @var string
     */
    private string $Town;
    /**
     * @var string
     */
    private string $PostCode;
    /**
     * @var string
     */
    private String $LoyaltyNo;
    /**
     * @var Order[]
     */
    private array $Orders;
    /**
     * @var Appointment[]
     */
    private array $Appointments;


    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return string
     */
    public function getID(): string{ return $this->id; }

    /**
     * @param string $id
     */
    public function setID(string $id): void{$this->id = $id;}

    /**
     * @return string
     */
    public function getFullName(): string{return $this->FullName;}
    /**
     * @param string $FullName
     */
    public function setFullName(string $FullName): void { $this->FullName = $FullName;}

    /**
     * @return string
     */
    public function getEmail(): string{return $this->Email;}

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void{$this->Email = $Email;}

    /**
     * @return  string
     */
    public function getContactNo(): string{ return $this->ContactNo; }

    /**
     * @param string $ContactNo
     */
    public function setContactNo(string $ContactNo): void{ $this->ContactNo = $ContactNo; }

    /**
     * @return  string
     */
    public function getPassword(): string { return $this->Password; }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void { $this->Password = $Password; }

    /**
     * @return string
     */
    public function getRole(): string { return $this->Role; }

    /**
     * @param string $Role
     */
    public function setRole(string $Role): void { $this->Role = $Role; }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->AddressLine1;
    }

    /**
     * @param string $AddressLine1
     */
    public function setAddressLine1(string $AddressLine1): void
    {
        $this->AddressLine1 = $AddressLine1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->AddressLine2;
    }

    /**
     * @param string $AddressLine2
     */
    public function setAddressLine2(string $AddressLine2): void
    {
        $this->AddressLine2 = $AddressLine2;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->Town;
    }

    /**
     * @param string $Town
     */
    public function setTown(string $Town): void
    {
        $this->Town = $Town;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->PostCode;
    }

    /**
     * @param string $PostCode
     */
    public function setPostCode(string $PostCode): void
    {
        $this->PostCode = $PostCode;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->Orders;
    }

    /**
     * @param Order[] $Orders
     */
    public function setOrders(array $Orders): void
    {
        $this->Orders = $Orders;
    }

    /**
     * @return Appointment[]
     */
    public function getAppointments(): array
    {
        return $this->Appointments;
    }

    /**
     * @param Appointment[] $Appointments
     */
    public function setAppointments(array $Appointments): void
    {
        $this->Appointments = $Appointments;
    }

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    function __construct(array $attributes = [
        'id' => "-1",
        'FullName' => "Andrew Warnock",
        'Email' => "30407681@bigvisiongames.co.uk",
        'ContactNo' => "",
        'Password' => "",
        'role' => "Customer",
        'AddressLine1' => "",
        'AddressLine2' => "",
        'Town' => "",
        'PostCode' => "",
        'LoyaltyNo' => "",
        'Orders' => [new Order(),],
        'Appointments' => [new Appointment(),],
    ])
    {
        parent::__construct($attributes);
        $this->id = $attributes["id"];
        $this->FullName = $attributes["FullName"];
        $this->Email = $attributes["Email"];
        $this->ContactNo = $attributes["ContactNo"];
        $this->Password = $attributes["Password"];
        $this->Role = $attributes["role"];

        $this->fillable['name'] = $attributes["FullName"];
        $this->fillable['email'] = $attributes["Email"];
        $this->fillable['password'] = $attributes["Password"];
        $this->fillable['role'] = $attributes["role"];


        $this->hidden['password'] = $attributes["Password"];

        //To be checked only during login, crashes registration
        //$this->hidden['remember_token'] = $attributes["remember_token"];

        //Customer Specific
        $this->AddressLine1     = $attributes['AddressLine1'];
        $this->AddressLine2     = $attributes['AddressLine2'];
        $this->Town             = $attributes['Town'];
        $this->PostCode         = $attributes['PostCode'];
        $this->LoyaltyNo        = $attributes['LoyaltyNo'];
        $this->Orders           = $attributes['Orders'];
        $this->Appointments     = $attributes['Appointments'];
    }

    // ===================================
    //        GENERATED
    //=====================================

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
