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
    public function getID(): string{ return $this->fillable['id']; }

    /**
     * @param string $id
     */
    public function setID(string $id): void{$this->fillable['id'] = $id;}

    /**
     * @return string
     */
    public function getFullName(): string{return $this->fillable['name'];}
    /**
     * @param string $FullName
     */
    public function setFullName(string $FullName): void { $this->fillable['name'] = $FullName;}

    /**
     * @return string
     */
    public function getEmail(): string{return $this->fillable['email'];}

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void{$this->fillable['email'] = $Email;}

    /**
     * @return  string
     */
    public function getContactNo(): string{ return $this->fillable['ContactNo']; }

    /**
     * @param string $ContactNo
     */
    public function setContactNo(string $ContactNo): void{ $this->fillable['ContactNo'] = $ContactNo; }

    /**
     * @return  string
     */
    public function getPassword(): string { return $this->fillable['password']; }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void { $this->fillable['password'] = $Password; }

    /**
     * @return string
     */
    public function getRole(): string { return $this->fillable['role']; }

    /**
     * @param string $Role
     */
    public function setRole(string $Role): void { $this->fillable['role'] = $Role; }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->fillable['AddressLine1'];
    }

    /**
     * @param string $AddressLine1
     */
    public function setAddressLine1(string $AddressLine1): void
    {
        $this->fillable['AddressLine1'] = $AddressLine1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->fillable['AddressLine2'];
    }

    /**
     * @param string $AddressLine2
     */
    public function setAddressLine2(string $AddressLine2): void
    {
        $this->fillable['AddressLine2'] = $AddressLine2;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->fillable['Town'];
    }

    /**
     * @param string $Town
     */
    public function setTown(string $Town): void
    {
        $this->fillable['Town'] = $Town;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->fillable['PostCode'];
    }

    /**
     * @param string $PostCode
     */
    public function setPostCode(string $PostCode): void
    {
        $this->fillable['PostCode'] = $PostCode;
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
        'name' => "Andrew Warnock",
        'email' => "30407681@bigvisiongames.co.uk",
        'ContactNo' => "",
        'password' => "",
        'role' => "Customer",
        'AddressLine1' => "",
        'AddressLine2' => "",
        'Town' => "",
        'PostCode' => "",
        'visionary_id' => ""
    ])
    {
        parent::__construct($attributes);

        $this->fillable['name'] = $attributes["name"];
        $this->fillable['email'] = $attributes["email"];
        $this->fillable['password'] = $attributes["password"];
        $this->fillable['role'] = $attributes["role"];


        $this->hidden['password'] = $attributes["password"];

        //Customer Specific
        $this->fillable['AddressLine1'] = $attributes['AddressLine1'];
        $this->fillable['AddressLine2']     = $attributes['AddressLine2'];
        $this->fillable['Town']             = $attributes['Town'];
        $this->fillable['PostCode']         = $attributes['PostCode'];
        $this->fillable['visionary_id']        = $attributes['visionary_id'];
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
        'role',
        'AddressLine1',
        'AddressLine2',
        'Town',
        'PostCode',
        'visionary_id'
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
