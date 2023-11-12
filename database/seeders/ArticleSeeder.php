<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'Sample Article 1',
            'content' => 'The day has been coming for a while now. One week after eliminating the last two social media platforms left standing in my world — Facebook and LinkedIn — I have said so long to my Spotify Premium subscription.

I have a feeling I will miss it about as much as I miss Netflix, which I got rid of this past January.

So hooray for me.

I’m not sure what it was that finally made me push it over the edge of the cliff. I wasn’t dissatisfied with their service, which I assured them of in their exit questionnaire. After, all the music I could ever want was at my fingertips.

It wasn’t the latest dollar per month increase either, I had weathered those before and I think by now we all realize it’s just par for the course with these things.

It wasn’t that I was overwhelmed by the business model, which requires — like all other social media and subscription based apps — that I buy into the illusion of endlessness of content, such that even if I give 24 hours a day to it, I could never possibly get to the end of it.

It wasn’t because I had finally come to my senses and taken a stand over the way they pay artists for plays on the platform. I was interested in the inequity that it involved up to a point, but not really being able to do anything about it, eventually just sort of shrugged my shoulders over it.

It wasn’t even that I really had stopped using it, in the past half a year either. I think the whole operation works on the same premise as gym memberships: 20% of customers use it a lot, 60% use it enough and 20% forget they have it and continue to pay for it each month.

That last group is the sweet spot with things like this.

No, it simply has to do with the fact that Spotify is not the way I want to listen to music anymore.

My legion of readers will know that at the start of the year, I made the switch back to buying and collecting vinyl and it has been an unmitigated pleasure.

',
            'user_id' => 1, // Associate with user by user ID
            'brief_content' => 'A brief description of the article.',
            'image' => 'article1.jpg', // Set the image file name
        ]);

        Article::create([
            'title' => 'Sample Article 2',
            'content' => 'It’s happening. OpenAI’s losing the AI race.

Remember those days when ChatGPT was everyone’s topic of conversation? Yes, you do.
Remember those days when BeReal was everywhere? Yes, you do.
Remember those days when Vine was the most trending app? Uh, maybe?
What about when YikYak was everyone’s app? Yik-what?
Go back to high school. There’s always that popular girl in school for a few years. Ten years later, you’ll probably say, “Gosh, I haven’t heard that name in years.”

There are no hypes that last forever. Every single business or venture will decline one day or another.

Yes, WhatsApp won’t be used forever.
Apple is going to be historical.
Teslas are going to be sold as antiques.

Image from Harvard Business Review
On the one hand, if you’re working on a product, hype is what you’re looking for.
On the other hand, you will have an enormous challenge dealing with the “post-hype.”
I’ve written an article analyzing how Google Bard will destroy ChatGPT because it’s a long-term game, and Google has the upper hand in terms of market dominance. ChatGPT has a better product, but that doesn’t mean they’ll win the long race.

This was quite the trending article reaching 178,000 people. There were quite the mixed emotions towards it. Some agreed that Google had the upper hand. Others think that ChatGPT has a “first-movers advantage.”

Now let’s resume the conversation. Ever since then, Google has been developing and waiting for the hype to fade. Their stock has been on the rise because many believe in their AI investments.

Finally, OpenAI made a few moves that made me believe that they’re moving more toward the losing side of the race. Let me elaborate; it’ll be fun.

',
            'user_id' => 1, // Associate with user by user ID
            'brief_content' => 'A brief description of the article.',
            'image' => 'article2.jpg', // Set the image file name
        ]);

        // Add more articles as needed
    }
}

