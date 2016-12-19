<?php

namespace M2I\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use M2I\BlogBundle\Entity\Article;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
	public function myLastCommentList(Article $article)
	{
		$qb = $this->createQueryBuilder('a');

		$qb
			->where('a.article = :article')
			->setParameter('article', $article);

		$qb->orderBy('a.createDate', 'DESC');
		$qb->setMaxResults(2);
		return $qb->getQuery()->getResult();
	}
}