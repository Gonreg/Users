<?php

namespace application\lib;

class Db
{
    /**
     *Константа с базой данных в json файле
     */
    private const JSON = 'application/Db/jsonDb.json';

    public function getRecords()
    {
        if (file_exists(self::JSON)) {
            $jsonData = file_get_contents(self::JSON);
            $data = json_decode($jsonData, true,);

            return !empty($data) ? $data : false;
        }
        return false;
    }

    /**
     * Метод возвращает массив с данными пользователя
     *
     * @param $valueData
     * @param $keyData
     *
     * @return mixed
     */
    public function getSingleRecord($valueData, $keyData)
    {
        $jsonData = file_get_contents(self::JSON);
        $data = json_decode($jsonData, true);
        if (!empty($data)) {
            foreach ($data as $user) {
                if ($valueData === $user[$keyData]) {
                    return $user;
                }
            }
        }
        return false;
    }

    /**
     * Метод добавляет нового пользователя в json файл
     *
     * @param $newData
     *
     * @return false|int
     */
    public function insert($newData)
    {
        if (!empty($newData)) {
            $id = time();
            $newData['id'] = $id;

            $jsonData = file_get_contents(self::JSON);
            $data = json_decode($jsonData, true);

            $data = !empty($data) ? array_filter($data) : $data;
            if (!empty($data)) {
                array_push($data, $newData);
            } else {
                $data[] = $newData;
            }
            $insert = file_put_contents(self::JSON, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $insert ? $id : false;
        } else {
            return false;
        }
    }

    /**
     * Метод обновляет данные о имеющемся пользователе в json файле
     *
     * @param $upData
     * @param $id
     *
     * @return bool
     */
    public function update($upData, $id): bool
    {
        if (!empty($upData) && is_array($upData) && !empty($id)) {
            $jsonData = file_get_contents(self::JSON);
            $data = json_decode($jsonData, true);

            foreach ($data as $key => $value) {
                if ($value['id'] == $id) {
                    if (isset($upData['login'])) {
                        $data[$key]['login'] = $upData['login'];
                    }
                    if (isset($upData['email'])) {
                        $data[$key]['email'] = $upData['email'];
                    }
                    if (isset($upData['name'])) {
                        $data[$key]['name'] = $upData['name'];
                    }
                    if (isset($upData['family'])) {
                        $data[$key]['family'] = $upData['family'];
                    }
                    if (isset($upData['password'])) {
                        $data[$key]['password'] = $upData['password'];
                    }

                }
            }
            $update = file_put_contents(self::JSON, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return (bool)$update;
        } else {
            return false;
        }
    }

    /**
     * Метод удаляет пользователя из json файла
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id): bool
    {
        $jsonData = file_get_contents(self::JSON);
        $data = json_decode($jsonData, true);

        $newData = array_filter($data, function ($var) use ($id) {
            return ($var['id'] != $id);
        });
        $delete = file_put_contents(self::JSON, json_encode($newData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return (bool)$delete;
    }

    /**
     * Метод ищет пользователя в json файле, в случае успеха возвращается false
     *
     * @param $valueData
     * @param $keyData
     *
     * @return bool
     */
    public function findRecord($valueData, $keyData): bool
    {
        $jsonData = file_get_contents(self::JSON);
        $data = json_decode($jsonData, true);
        if (!empty($data)) {
            foreach ($data as $key) {
                if ($valueData === $key[$keyData]) {
                    return false;
                }
            }
        }
        return true;
    }

}