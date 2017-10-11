<?php
/**
 * Author: Anton Orlov
 * Date: 09.10.2017
 * Time: 23:38
 */

namespace App\Http\Controllers;


use App\Http\Requests\BalanceRequest;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferRequest;
use App\Services\AccountingService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends AbstractApiController
{
    /** @var AccountingService */
    private $service;

    /**
     * @param AccountingService $service
     */
    public function setAccountingService(AccountingService $service)
    {
        $this->service = $service;
    }
    /**
     * @presenter App\Presenters\Balance
     * @param BalanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function balanceAction(BalanceRequest $request)
    {
        $userId = (int) $request->get('user');
        if (!($user = $this->service->getUserBalanceById($userId))) {
            throw new NotFoundHttpException(sprintf('User %d does not exists', $userId));
        }
        return $this->response($user);
    }

    /**
     * @presenter App\Presenters\Balance
     * @param DepositRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function depositAction(DepositRequest $request)
    {
        $user = $this->service->depositUserById($request->get('user'), $request->get('amount'));
        return $this->response($user);
    }

    /**
     * @presenter App\Presenters\Balance
     * @param DepositRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function withdrawAction(DepositRequest $request)
    {
        $userId = (int) $request->get('user');
        $user = $this->service->withdrawUserById($userId, $request->get('amount'));
        if (!$user) {
            throw new NotFoundHttpException(sprintf('User %d does not exists', $userId));
        }
        return $this->response($user);
    }

    /**
     * @presenter App\Presenters\Transfer
     * @param TransferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function transferAction(TransferRequest $request)
    {
        $transaction = $this->service->transferByUserId(
            $request->get('from'),
            $request->get('to'),
            $request->get('amount')
        );
        return $this->response($transaction);
    }
}