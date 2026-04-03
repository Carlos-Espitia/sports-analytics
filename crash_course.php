<?php

// ============================================================
// 1. BASIC CLASS
// ============================================================
// A class is a blueprint. An object is an instance of that blueprint.
// Same concept as Java/Python classes.

class Car {
    // Properties — variables that belong to the class
    public string $brand;
    public int $year;

    // Constructor — runs when you do "new Car(...)"
    public function __construct(string $brand, int $year) {
        $this->brand = $brand;  // $this = the current instance (like "this" in Java)
        $this->year  = $year;
    }

    // Method — function that belongs to the class
    public function describe(): string {
        return "{$this->year} {$this->brand}";
    }
}

$car = new Car("Toyota", 2022);
echo $car->describe() . "\n";   // "2022 Toyota"
echo $car->brand . "\n";        // "Toyota"


// ============================================================
// 2. VISIBILITY: public, protected, private
// ============================================================
// Same as Java. Controls who can access the property/method.

class BankAccount {
    public string $owner;        // anyone can read/write
    protected float $balance;   // only this class and subclasses
    private string $pin;        // only this class

    public function __construct(string $owner, float $balance, string $pin) {
        $this->owner   = $owner;
        $this->balance = $balance;
        $this->pin     = $pin;
    }

    public function getBalance(): float {
        return $this->balance;  // controlled access to private data
    }

    public function deposit(float $amount): void {
        $this->balance += $amount;
    }
}

$account = new BankAccount("Carlo", 1000.00, "1234");
echo $account->owner . "\n";        // works — public
echo $account->getBalance() . "\n"; // works — public method
// echo $account->pin;              // ERROR — private


// ============================================================
// 3. INHERITANCE
// ============================================================
// A child class extends a parent and inherits its properties/methods.

class Animal {
    public string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function speak(): string {
        return "...";
    }
}

class Dog extends Animal {
    // Override the parent method
    public function speak(): string {
        return "{$this->name} says Woof!";
    }
}

class Cat extends Animal {
    public function speak(): string {
        return "{$this->name} says Meow!";
    }
}

$dog = new Dog("Rex");
$cat = new Cat("Whiskers");
echo $dog->speak() . "\n";  // "Rex says Woof!"
echo $cat->speak() . "\n";  // "Whiskers says Meow!"


// ============================================================
// 4. ABSTRACT CLASSES
// ============================================================
// A class you can't instantiate directly — only use as a parent.
// Forces child classes to implement certain methods.
// You'll see this in Laravel: every Controller extends Controller,
// every Model extends Model. Those base classes are abstract-like.

abstract class Shape {
    abstract public function area(): float;  // must be implemented by child

    public function describe(): string {
        return "This shape has area: " . $this->area();
    }
}

class Circle extends Shape {
    public function __construct(private float $radius) {}

    public function area(): float {
        return M_PI * $this->radius ** 2;
    }
}

class Rectangle extends Shape {
    public function __construct(
        private float $width,
        private float $height
    ) {}

    public function area(): float {
        return $this->width * $this->height;
    }
}

$circle = new Circle(5);
$rect   = new Rectangle(4, 6);
echo $circle->describe() . "\n";  // "This shape has area: 78.539..."
echo $rect->describe() . "\n";    // "This shape has area: 24"


// ============================================================
// 5. INTERFACES
// ============================================================
// A contract — defines what methods a class MUST have.
// A class can implement multiple interfaces (unlike single inheritance).
// You'll see this a lot in Laravel service classes.

interface Syncable {
    public function sync(): void;
}

interface Loggable {
    public function log(string $message): void;
}

// A class can implement multiple interfaces
class DataSyncer implements Syncable, Loggable {
    public function sync(): void {
        $this->log("Syncing data...");
        echo "Data synced!\n";
    }

    public function log(string $message): void {
        echo "[LOG] $message\n";
    }
}

$syncer = new DataSyncer();
$syncer->sync();


// ============================================================
// 6. STATIC METHODS AND PROPERTIES
// ============================================================
// Called on the CLASS itself, not an instance.
// Use :: instead of ->
// You see this constantly in Laravel: Team::find(1), Route::get(...)

class MathHelper {
    public static function square(int $n): int {
        return $n * $n;
    }

    public static function cube(int $n): int {
        return $n * $n * $n;
    }
}

echo MathHelper::square(4) . "\n";  // 16 — no "new" needed
echo MathHelper::cube(3) . "\n";    // 27


// ============================================================
// 7. CONSTRUCTOR PROMOTION (PHP 8+)
// ============================================================
// Shorthand that declares AND assigns properties in one line.
// You'll see this everywhere in modern Laravel code.

// Old way:
class OldStyle {
    public string $name;
    public int $age;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age  = $age;
    }
}

// New way (PHP 8) — exact same result, much less code:
class NewStyle {
    public function __construct(
        public string $name,
        public int $age
    ) {}
}

$obj = new NewStyle("Carlo", 20);
echo $obj->name . "\n";  // "Carlo"


// ============================================================
// 8. HOW LARAVEL USES CLASSES
// ============================================================
// Everything in Laravel is a class. Here's what each type does:

// MODEL — represents a database table
// class Team extends Model { ... }
// Team::find(1)  → SELECT * FROM teams WHERE id = 1
// $team->save()  → UPDATE teams SET ...

// CONTROLLER — handles HTTP requests
// class StandingsController extends Controller {
//     public function index() {
//         return Inertia::render('Soccer/Standings', [...]);
//     }
// }

// SERVICE — handles business logic / external API calls
// class FootballApiService {
//     public function getStandings(...): array { ... }
// }

// COMMAND — runs via php artisan
// class SyncFootballData extends Command {
//     public function handle(): void { ... }
// }

// SEEDER — inserts test data
// class TeamSeeder extends Seeder {
//     public function run(): void { ... }
// }

// MIGRATION — defines database schema changes
// class CreateTeamsTable extends Migration {
//     public function up(): void { Schema::create(...) }
//     public function down(): void { Schema::dropIfExists(...) }
// }

echo "\nAll done!\n";
