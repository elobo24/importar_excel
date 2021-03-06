<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Encargos;
use \Excel;
use Validator;
use JavaScript;
use App\Http\Requests\ExcelRequest;
use Session;
use DB;
use Illuminate\Database\Connection;
use Yajra\Datatables\Facades\Datatables;
use Jenssegers\Date\Date;
use Input;
use Response;

class ExcelController extends Controller
{
    protected $request;
    protected $encargo;
    protected $data = [];
    protected $i = 1;
    protected $errors;
    protected $input;
    protected $rules;

    public function __construct(Request $request, Encargos $encargo)
    {
        $this->request = $request;
        $this->encargo = $encargo;
        $this->errors = [];
        $this->data = [];
        $this->rules = [
            'albaran'       => 'required|numeric|max:10',
            'destinatario'  => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:28',
            'direccion'     => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:250',
            'poblacion'     => 'required|regex:/^[A-z][A-z\s\.\']+$/|max:10',
            'cp'            => 'required|regex:/^[A-z][A-z\s\.\']+$/|min:5|max:5',
            'provincia'     => 'required|max:20',
            'telefono'      => 'required|numeric|max:10',
            'observaciones' => 'max:500',
            'fecha'         => 'required|date',
        ];
    }

    public function index()
    {
        return view('registro.index');
    }

    public function importFile(Request $request, Encargos $encargo)
    {
        $this->processData($request);

        return view('registro.export', [ 'data' => $this->data, 'errors' => $this->errors, 'input' => $this->input]);
    }

    /**
     * Validate cell against the rules.
     *
     * @param array $data
     * @param array $rules
     *
     * @return array
     */
    protected function validateCell(array $data, array $rules)
    {
        // validaciones
        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->messages();

            // mensaje
            foreach ($errorMessages as $key => $value) {
                $errorMessages = $value[0];
            }

            return $errorMessages;
        }

        return [];
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        if (!empty($this->errors)) {
            return view('registro.export', [
                'data' => $this->data,
                'errors' => $this->errors,
                'input' => $this->input
            ]);
        }

        foreach ($this->data as $data) {

            $data = array_except($data, ['id']);

            $encargo = new Encargos;
            $encargo->albaran = $data['albaran'];
            $encargo->destinatario = $data['destinatario'];
            $encargo->direccion = $data['direccion'];
            $encargo->poblacion = $data['poblacion'];
            $encargo->cp = $data['cp'];
            $encargo->provincia = $data['provincia'];
            $encargo->telefono = $data['telefono'];
            $encargo->observaciones = $data['observaciones'];
            $encargo->fecha = $data['fecha'];
            $encargo->save();
        }

        return redirect()->route('home')->with('info', 'Datos Guardados');
    }

    protected function processData($request)
    {
        Excel::selectSheetsByIndex(0)->load($request->excel, function($reader) {

            //$reader->formatDates(true, 'd-m-Y');

            $excel = $reader->get();

            $this->errors = [];
            $this->rowNumber = 0;

            $excel->each(function($row) {

                $this->data[$this->rowNumber] = [
                    'albaran'       => $row->albaran,
                    'destinatario'  => $row->destinatario,
                    'direccion'     => $row->direccion,
                    'poblacion'     => $row->poblacion,
                    'cp'            => $row->cp,
                    'provincia'     => $row->provincia,
                    'telefono'      => $row->telefono,
                    'observaciones' => $row->observaciones,
                    'fecha'         => $row->fecha,
                ];

                foreach ($this->data[$this->rowNumber] as $key => $value) {

                    $error = $this->validateCell([$key => $value], [$key => $this->rules[$key]]);

                    if (!empty($error)) {
                        $this->errors[$this->rowNumber][$key] = $error;
                    }

                }

                $this->data[$this->rowNumber]['id'] = $this->rowNumber;

                $this->rowNumber++;
            });
        });
    }

    protected function validateData($request)
    {
        $data = $request->except('_token');

        $this->errors = [];
        $this->rowNumber = 0;

        foreach ($data as $dataKey => $value) {

            $i = 0;

            foreach ($value as $item) {

                $error = $this->validateCell([$dataKey => $item], [$dataKey => $this->rules[$dataKey]]);

                if (!empty($error)) {
                    $this->errors[$i][$dataKey] = $error;
                }

                $this->data[$i]['id'] = $i;

                $this->data[$i][$dataKey] = $item;

                $i++;
            }
        }
    }
}
