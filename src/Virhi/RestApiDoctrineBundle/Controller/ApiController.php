<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 06/10/2014
 * Time: 14:19
 */

namespace Virhi\RestApiDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    public function apiAction()
    {
        $doctrine = $this->get("doctrine");


        $connection = $doctrine->getConnection();
        $sm = $connection->getSchemaManager();

        $tables = $sm->listTables();

        foreach ($tables as $table) {

            var_dump(get_class($table));
            var_dump("Table : " . $table->getName() );

            foreach ($table->getColumns() as $column) {
                var_dump("columns : " . $column->getName() );
            }
        }
    }

    public function entitInfoAction()
    {
        $doctrine = $this->get("doctrine");
        $entityManager = $doctrine->getEntityManager();

        $entityClassNames = $entityManager->getConfiguration()
            ->getMetadataDriverImpl()
            ->getAllClassNames();


        foreach ($entityClassNames as $entityClassName) {
            var_dump($entityClassName);
        }

        die;
    }
}
