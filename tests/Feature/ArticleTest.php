<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ArticleTest extends TestCase
{

    public function testApprovedScope()
    {
        // Create permissions
        Permission::create(['name' => 'create.articles']);
        Permission::create(['name' => 'edit.articles']);
        Permission::create(['name' => 'approve.articles']);
        Permission::create(['name' => 'destroy.articles']);

        Permission::create(['name' => 'create.comment']);
        Permission::create(['name' => 'destroy.comment']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('create.articles', 'edit.articles',"destroy.articles", 'approve.articles',"destroy.comment",'create.comment');

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('create.articles', 'edit.articles',"destroy.articles","destroy.comment",'create.comment');

        // Create some approved and non-approved articles
        $approvedArticle = Article::factory()->approved()->create();
        $nonApprovedArticle = Article::factory()->create();

        // Use the approved scope to fetch approved articles
        $approvedArticles = Article::approved()->get();

        // Assert that only the approved article is included
        $this->assertTrue($approvedArticles->contains($approvedArticle));
        $this->assertFalse($approvedArticles->contains($nonApprovedArticle));
    }

    public function testCreateArticle()
    {
        // Simulate an authenticated user
        $user = User::factory()->create();
        $user->assignRole('user'); // Assign the 'user' role
        $this->actingAs($user);

        // Send a POST request to create an article
        $response = $this->post('/articles', [
            'title' => 'Test Article',
            'content' => 'This is a test article content.',
            // Add other required fields
        ]);

        // Assert that the article was created and the user is redirected to a specific page
        $response->assertStatus(302); // Check for the HTTP status code
        $response->assertRedirect('/myArticle'); // Check the redirection
    }

    public function testUpdateArticle()
    {
        // Simulate an authenticated user
        $user = User::factory()->create();
        $user->assignRole('user');
        $this->actingAs($user);

        // Create a test article
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        // Send a PUT request to update the article
        $response =  $this->put("/articles/{$article->id}/update", [
            'title' => 'Updated Article Title',
            'content' => 'Updated article content.',
            // Add other required fields
        ]);

        // Assert that the article was updated and the user is redirected to a specific page
        $response->assertStatus(302); // Check for the HTTP status code
        $response->assertRedirect('/myArticle'); // Check the redirection
    }

    public function testDeleteArticle()
    {
        // Simulate an authenticated user
        $user = User::factory()->create();
        $user->assignRole('user');
        $this->actingAs($user);

        // Create a test article
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        // Send a DELETE request to delete the article
        $response = $this->delete("/articles/{$article->id}/destroy");

        // Assert that the article was deleted and the user is redirected to a specific page
        $response->assertStatus(302); // Check for the HTTP status code
        $response->assertRedirect('/myArticle'); // Check the redirection
    }

    public function testApproveArticle()
    {
        // Simulate an authenticated admin user
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        // Create a test article
        $article = Article::factory()->create();

        // Send a POST request to approve the article
        $response = $this->post("/articles/approve/{$article->id}");

        // Assert that the article was approved and the user is redirected to a specific page
        $response->assertStatus(302); // Check for the HTTP status code
        $response->assertRedirect('/admin/articles'); // Check the redirection
    }
}
