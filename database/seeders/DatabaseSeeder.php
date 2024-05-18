<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Car;
use App\Models\OilChange;
use App\Models\Penalty;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        User::create([
            'name' => 'Виктория Администратор',
            'role' => 'admin',
            'email' => 'victoria.admin@mail.ru',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $drivers = [
            ['name' => 'Нургиса', 'email' => 'nurgisa.taxidriver@mail.ru'],
            ['name' => 'Артур', 'email' => 'artur.taxidriver@mail.ru'],
            ['name' => 'Нариман', 'email' => 'nariman.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Адильбек', 'email' => 'adilbek.taxidriver@mail.ru'],
            ['name' => 'Бауыржан', 'email' => 'bauyrzhan.taxidriver@mail.ru', 'phone' => '87077700915'],
            ['name' => 'Кайрат', 'email' => 'kairat.taxidriver@mail.ru'],
            ['name' => 'Рауан', 'email' => 'rauan.taxidriver@mail.ru', 'phone' => '87075447054'],
            ['name' => 'Руслан', 'email' => 'ruslan.taxidriver@mail.ru', 'phone' => '87002797907'],
            ['name' => 'Ернур', 'email' => 'ernur.taxidriver@mail.ru'],
            ['name' => 'Акжол', 'email' => 'akzhol.taxidriver@mail.ru'],
            ['name' => 'Адилет', 'email' => 'adilet.taxidriver@mail.ru'],
            ['name' => 'Абубакир', 'email' => 'abubakir.taxidriver@mail.ru', 'phone' => '87476391929'],
            ['name' => 'Айбар', 'email' => 'aibar.taxidriver@mail.ru'],
            ['name' => 'Роксана', 'email' => 'roksana.taxidriver@mail.ru'],
            ['name' => 'Жалгас', 'email' => 'zhalgas.taxidriver@mail.ru'],
            ['name' => 'Алтынбек', 'email' => 'altynbek.taxidriver@mail.ru'],
            ['name' => 'Фара', 'email' => 'fara.taxidriver@mail.ru'],
            ['name' => 'Диас', 'email' => 'dias.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Жандос', 'email' => 'zhandos.taxidriver@mail.ru', 'phone' => '87075447054'],
            ['name' => 'Айбол', 'email' => 'aibol.taxidriver@mail.ru'],
            ['name' => 'Аслан', 'email' => 'aslan.taxidriver@mail.ru', 'phone' => '87472142470'],
            ['name' => 'Сабир', 'email' => 'sabir.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Ерсултан', 'email' => 'ersultan.taxidriver@mail.ru'],
            ['name' => 'Бекзат', 'email' => 'bekzat.taxidriver@mail.ru'],
            ['name' => 'Нуркен', 'email' => 'nurken.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Дамир', 'email' => 'damir.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Муслим', 'email' => 'muslim.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Мирас', 'email' => 'miras.taxidriver@mail.ru'],
            ['name' => 'Фаизмамад', 'email' => 'faizmamad.taxidriver@mail.ru'],
            ['name' => 'Жаныбек', 'email' => 'zhanybek.taxidriver@mail.ru'],
            ['name' => 'Бинара', 'email' => 'binara.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Абдурахмани', 'email' => 'abdurakhmani.taxidriver@mail.ru'],
            ['name' => 'Малик', 'email' => 'malik.taxidriver@mail.ru'],
            ['name' => 'Асылхан', 'email' => 'asylkhan.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Асем', 'email' => 'asem.taxidriver@mail.ru', 'phone' => '87769999177'],
            ['name' => 'Дастан', 'email' => 'dastan.taxidriver@mail.ru', 'phone' => '87055916662'],
            ['name' => 'Ислам', 'email' => 'islam.taxidriver@mail.ru',  'phone' => '87079595013'],
            ['name' => 'Бакыт', 'email' => 'bakyt.taxidriver@mail.ru',  'phone' => '87079595013'],
            ['name' => 'Эльдар', 'email' => 'El-dar.taxidriver@mail.ru',  'phone' => '87079595013'],
            ['name' => 'Галым', 'email' => 'galym.taxidriver@mail.ru',  'phone' => '87079595013'],
            ['name' => 'Шахизада', 'email' => 'shakhizada.taxidriver@mail.ru',  'phone' => '87017622222'],
            ['name' => 'Нурбол', 'email' => 'nurbol.taxidriver@mail.ru',  'phone' => '87475998717'],
            ['name' => 'Жанибек', 'email' => 'zhanibek.taxidriver@mail.ru',  'phone' => '87025552320'],
            ['name' => 'Арви', 'email' => 'arvi.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Айгерим', 'email' => 'aigerim.taxidriver@mail.ru', 'phone' => '87079595013'],
            ['name' => 'Санатжан', 'email' => 'sanatzhan.taxidriver@mail.ru', 'phone' => '87071509445'],
            ['name' => 'Ильяс', 'email' => 'ilias.taxidriver@mail.ru'],
        ];

        $driverAdditionalData = [
            'role' => 'taxi_driver',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        foreach ($drivers as $driver) {
            User::create(array_merge($driver, $driverAdditionalData));
        }

        $cars = [
            ['state_number' => '357ER02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '360ER02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '396ER02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '675AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '713AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '741AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 22000],
            ['state_number' => '695AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '799AWD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '807AWD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '814AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '830AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '847AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '849AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '850AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '684AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '753AXD02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '762BC04', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '766BC04', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '918ER02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '806ER02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '999FZA02', 'brand' => 'Volkswagen', 'model' => 'Passat', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '099AYY02', 'brand' => 'Volkswagen', 'model' => 'Passat', 'year' => 2023, 'amount' => 18000],
            ['state_number' => '999FWA02', 'brand' => 'Volkswagen', 'model' => 'Passat', 'year' => 2023, 'amount' => 0],
            ['state_number' => '501AVV02', 'brand' => 'Toyota', 'model' => 'Camry', 'year' => 2020, 'amount' => 23000],
            ['state_number' => '578AWZ02', 'brand' => 'Hyunday', 'model' => 'Elantra', 'year' => 2019, 'amount' => 18000],
            ['state_number' => '569AXX02', 'brand' => 'Hyunday', 'model' => 'Elantra', 'year' => 2019, 'amount' => 18000],
            ['state_number' => '511AXC02', 'brand' => 'Hyunday', 'model' => 'Elantra', 'year' => 2018, 'amount' => 18000],
            ['state_number' => '568ATW02', 'brand' => 'Toyota', 'model' => 'Camry', 'year' => 2020, 'amount' => 25000],
            ['state_number' => '045AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '309AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '315AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '355AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '366AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '514AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '132AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '139AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '158AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '224AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '256AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '261AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '280AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '281AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '305AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '317AZC02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '342AYZ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '369AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '374AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '606AZQ02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '721AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '841AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '873AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '874AZB02', 'brand' => 'Exeed', 'model' => 'LX', 'year' => 2023, 'amount' => 20000],
            ['state_number' => '999DAU02', 'brand' => 'Toyota', 'model' => 'Prado', 'year' => 2020, 'amount' => 55000],
            ['state_number' => '072BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '068BAH02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '021BAH02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '048BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '411BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '557BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '775BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '994BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '855BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '034BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '240BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '240BAH02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '290BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '330BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '337BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '399BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '430BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '499BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '850BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
            ['state_number' => '977BAG02', 'brand' => 'Geely', 'model' => 'ATLAS', 'year' => 2024, 'amount' => 20000],
        ];

        foreach ($cars as $item) {
            $car = Car::create($item);

            OilChange::create([
                'car_id' => $car->id,
                'mileage' => rand(1000, 5000),
                'changed_at' => date('Y-m-d', strtotime('-2 year')),
            ]);

            OilChange::create([
                'car_id' => $car->id,
                'mileage' => rand(5000, 10000),
                'changed_at' => date('Y-m-d', strtotime('-1 year')),
            ]);

            OilChange::create([
                'car_id' => $car->id,
                'mileage' => rand(10000, 15000),
                'changed_at' => date('Y-m-d', strtotime('-1 week')),
            ]);

            OilChange::create([
                'car_id' => $car->id,
                'mileage' => rand(10000, 15000),
                'changed_at' => date('Y-m-d', strtotime('-1 week')),
            ]);
        }

        Rent::factory()
            ->count(1000)
            ->has(Penalty::factory()->count(3))
            ->create();
    }
}
