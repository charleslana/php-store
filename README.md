//example

$db = new Database();
$clients = $db->select('SELECT * FROM clients');
echo '<pre>';
print_r($clients);
echo $clients[0]->name;
//$db->statement('TRUNCATE clients');