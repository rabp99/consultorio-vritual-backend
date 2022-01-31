<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecipeDetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecipeDetailsTable Test Case
 */
class RecipeDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RecipeDetailsTable
     */
    protected $RecipeDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RecipeDetails',
        'app.Recipes',
        'app.Medicines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RecipeDetails') ? [] : ['className' => RecipeDetailsTable::class];
        $this->RecipeDetails = $this->getTableLocator()->get('RecipeDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RecipeDetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RecipeDetailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RecipeDetailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
