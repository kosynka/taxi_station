<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractController extends Controller
{
    public function contractRent(Request $request)
    {
        $data = $request->validate([
            'rent_id' => ['required', 'integer', 'exists:rents,id'],
        ]);

        $rent = Rent::with(['car', 'driver'])->find($data['rent_id']);

        if ($rent->contract_file_path !== null) {
            $filePath = $rent->contract_file_path;
        } else {
            $filePath = $this->getContractFromTemplate(
                $rent->car,
                $rent->driver,
                'Договор аренды',
            );

            $rent->contract_file_path = $filePath;
            $rent->save();
        }

        return response()->download(storage_path($filePath));
    }

    public function contractRentWithBuy(Request $request)
    {
        $data = $request->validate([
            'rent_id' => ['required', 'integer', 'exists:rents,id'],
        ]);

        $rent = Rent::with(['car', 'driver'])->find($data['rent_id']);

        if ($rent->contract_with_buy_file_path !== null) {
            $filePath = $rent->contract_with_buy_file_path;
        } else {
            $filePath = $this->getContractWithBuyFromTemplate(
                $rent->car,
                $rent->driver,
                'Договор аренды с выкупом',
            );

            $rent->contract_with_buy_file_path = $filePath;
            $rent->save();
        }

        return response()->download(storage_path($filePath));
    }

    private function getContractFromTemplate(Car $car, User $driver, string $title): string
    {
        $template = new TemplateProcessor(storage_path('contract_template.docx'));

        $template->setValues([
            'DATE' => now()->format('«d» m Yг.'),
            'DRIVER_NAME' => $driver->name,
            'DRIVER_LICENSE_NUMBER' => $driver->driver_license_number,
            'DRIVER_LICENSE_DATE' => \Carbon\Carbon::parse($driver->driver_license_date)->format('d.m.Y'),
            'DRIVER_LICENSE_CATEGORIES' => $driver->driver_license_categories,
            'CAR_BRAND_MODEL' => $car->brand . ' ' . $car->model,
            'CAR_COLOR' => $car->color,
            'CAR_YEAR' => $car->year,
            'CAR_STATE_NUMBER' => $car->state_number,
            'CAR_VIN' => $car->vin,
            'CAR_ENGINE_CAPACITY' => $car->engine_capacity,
            'CAR_AMOUNT' => $car->amount,
            'DRIVER_IIN' => $driver->iin,
            'DRIVER_ID_DOC_NUMBER' => $driver->id_doc_number,
            'DRIVER_ID_DOC_DATE' => \Carbon\Carbon::parse($driver->id_doc_date)->format('d.m.Y'),
            'DRIVER_ID_DOC_UNTIL_DATE' => \Carbon\Carbon::parse($driver->id_doc_until_date)->format('d.m.Y'),
            'DRIVER_REGISTRATION_ADDRESS' => $driver->registration_address,
            'DRIVER_RESIDENCE_ADDRESS' => $driver->residence_address,
            'DRIVER_PHONE' => $driver->phone,
        ]);

        $filename = $title . ' ' .
            now()->format('d.m.Y') . ' ' .
            $car->state_number . ' ' . $driver->name . '.docx';

        $template->saveAs(storage_path($filename));

        return $filename;
    }

    private function getContractWithBuyFromTemplate(Car $car, User $driver, string $title): string
    {
        // TODO
        $filename = $title . ' ' .
            now()->format('d.m.Y') . ' ' .
            $car->state_number . ' ' . $driver->name . '.docx';

        return $filename;
    }
}
