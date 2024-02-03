<?php

namespace Src\services;

class ValidationService
{
    protected bool $validation = true;
    protected array $errors = [];

    /**
     * Valida baseado nas regras estipuladas
     *
     * @param array $data
     * @param array $rules
     * @return bool
     */
    public function validate(array $data, array $rules = []): bool {
        $this->errors = [];
        $validation = true;
        foreach($rules as $field => $rule) {
            foreach($rule as $param) {
                if(is_array($param)) {
                    foreach($param as $val => $par) {
                        $this->errors[$field] = $this->validateFieldWithParam($data, $field, $val, $par);
                    }
                } else
                    $this->errors[$field] = $this->validateField($data, $field, $param);
            }

            if($this->errors[$field] === true)
                unset($this->errors[$field]);
            else
                $validation = false;
        }

        $this->validation = $validation;

        return $validation;
    }

    /**
     * Valida campos com regra
     *
     * @param array $data
     * @param string $field
     * @param string $rule
     * @return string|true
     */
    private function validateField(array $data, string $field, string $rule) {
        switch($rule) {
            case 'required':
                if(!empty($data[$field]))
                    return true;
                else
                    return "Campo {$field} é obrigatório.";
            case 'email':
                if(isset($data[$field]) && filter_var($data[$field], FILTER_VALIDATE_EMAIL))
                    return true;
                else
                    return "Campo {$field} precisa ser um email válido.";
            default:
                return "Campo {$field} requer uma regra {$rule} não implementada.";
        }
    }

    /**
     * Valida campos com regra com parametrização
     *
     * @param $data
     * @param $field
     * @param $rule
     * @param $param
     * @return string|true
     */
    private function validateFieldWithParam(array $data, string $field, string $rule, $param) {
        switch($rule) {
            case 'length':
                if(isset($data[$field]) && strlen(trim($data[$field])) === $param)
                    return true;
                else
                    return "Campo {$field} requer exatamente {$param} caracteres.";
            default:
                return "Campo {$field} requer uma regra {$rule} não implementada.";
        }
    }

    /**
     * Retorna lista de erros
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Retorna status da validação
     * @return bool
     */
    public function validated(): bool {
        return $this->validation;
    }
}