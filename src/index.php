<?php

// 1. Setup & Autoloading
// Adjust this path if your vendor folder is in a different location
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}

/**
 * THE INTERFACE
 * Defines the "Contract". Any class that implements this MUST 
 * have these methods, ensuring consistency across different vehicle types.
 */
interface VehicleInterface {
    public function getMake(): string;
    public function getModel(): string;
    public function getSpecs(): string;
}

/**
 * THE CLASS
 * The "Blueprint". We use PHP 8+ Constructor Promotion to 
 * define properties and assign them in one step.
 */
class Vehicle implements VehicleInterface {
    public function __construct(
        private string $make,
        private string $model,
        private string $year,
        private string $type,
        private string $color,
        private string $image = "https://via.placeholder.com/300x180?text=Vehicle+Image"
    ) {}

    public function getMake(): string {
        return $this->make;
    }

    public function getModel(): string {
        return $this->model;
    }

    public function getYear(): string {
        return $this->year;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getImageUrl(): string {
        return $this->image;
    }

    // Implementing the mandatory Interface method
    public function getSpecs(): string {
        return "{$this->year} {$this->type} in {$this->color}";
    }
}

/**
 * OBJECT INSTANTIATION
 * We are creating "Objects" (Individual instances) from our "Class" (The Blueprint).
 */
$cars = [
    new Vehicle("Tesla", "Model S", "2024", "Electric", "Pearl White"),
    new Vehicle("Ford", "Mustang", "1969", "Classic Muscle", "Grabber Blue"),
    new Vehicle("Land Rover", "Defender", "2023", "Off-Road", "Pangea Green"),
    new Vehicle("Porsche", "911 GT3", "2024", "Sport", "Guards Red"),
    new Vehicle("Rivian", "R1T", "2024", "Electric Truck", "Rivian Blue"),
    new Vehicle("BMW", "M3", "2023", "Performance", "Isle of Man Green"),
];

// Pick a random object for the "Deal of the Day"
$featured = $cars[array_rand($cars)];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP: Vehicles & Interfaces</title>
    <style>
        :root { --primary: #2563eb; --bg: #f8fafc; --card: #ffffff; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: #1e293b; margin: 0; padding: 40px 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        header { text-align: center; margin-bottom: 40px; }
        .badge { background: #dbeafe; color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        
        /* Featured Section */
        .featured-box { 
            background: linear-gradient(135deg, #1e293b, #334155); 
            color: white; padding: 30px; border-radius: 16px; margin-bottom: 50px;
            display: flex; align-items: center; gap: 30px; flex-wrap: wrap;
        }
        .featured-box img { width: 300px; border-radius: 12px; object-fit: cover; }
        
        /* Grid Section */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .card { background: var(--card); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .card-content { padding: 20px; }
        .card img { width: 100%; height: 160px; object-fit: cover; background: #eee; }
        
        h1, h2, h3 { margin: 0 0 10px 0; }
        .specs { color: #64748b; font-size: 0.9rem; margin-bottom: 15px; }
        hr { border: 0; border-top: 1px solid #e2e8f0; margin: 40px 0; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Vehicle Showroom</h1>
        <p>Demonstrating <b>Interfaces</b>, <b>Classes</b>, and <b>Objects</b> in PHP</p>
    </header>

    <section class="featured-box">
        <div>
            <img src="<?= $featured->getImageUrl() ?>" alt="Featured Car">
        </div>
        <div>
            <span class="badge" style="background: #fef08a; color: #854d0e;">DEAL OF THE DAY</span>
            <h2 style="margin-top:10px;"><?= $featured->getMake() ?> <?= $featured->getModel() ?></h2>
            <p><?= $featured->getSpecs() ?></p>
            <p><i>This data is being pulled from a single "Vehicle" object instance.</i></p>
        </div>
    </section>

    <h2>Current Inventory</h2>
    <div class="grid">
        <?php foreach ($cars as $car): ?>
            <div class="card">
                <img src="<?= $car->getImageUrl() ?>" alt="Car image">
                <div class="card-content">
                    <span class="badge"><?= $car->getType() ?></span>
                    <h3 style="margin-top:10px;"><?= htmlspecialchars($car->getMake()) ?></h3>
                    <p style="margin-bottom:5px;">Model: <?= htmlspecialchars($car->getModel()) ?></p>
                    <p class="specs"><?= htmlspecialchars($car->getSpecs()) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>
    <footer style="font-size: 0.8rem; color: #94a3b8; text-align: center;">
        <p><b>OOP Tip:</b> The <code>VehicleInterface</code> ensures every object in this list has a <code>getSpecs()</code> method.</p>
    </footer>
</div>

</body>
</html>
